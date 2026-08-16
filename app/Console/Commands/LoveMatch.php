<?php

namespace App\Console\Commands;

// app/Console/Commands/LoveMatch.php

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserMatch;
use App\Models\QuizAnswer;
use App\Models\Notification;
use Carbon\Carbon;

class LoveMatch extends Command
{
    protected $signature   = 'love:match {--limit=50 : Max pairs to process} {--user= : Run for specific user ID}';
    protected $description = 'Run the Love Project smart matchmaking algorithm';

    // Score weights (must total 100)
    private array $weights = [
        'quiz'        => 35, // Quiz compatibility
        'interests'   => 20, // Shared interests
        'preferences' => 20, // Age/gender preference
        'values'      => 15, // Lifestyle values match
        'location'    => 10, // Distance proximity
    ];

    public function handle(): int
    {
        $this->info('💕 Running The Love Project Matchmaking Algorithm...');
        $this->info('');

        // Get active users with complete profiles
        $query = User::where('status', 'active')
            ->where('role', 'user')
            ->whereHas('profile', fn($q) => $q->where('is_complete', true));

        if ($this->option('user')) {
            $query->where('id', $this->option('user'));
        }

        $users = $query->with(['profile', 'quizAnswers.question'])->get();

        if ($users->count() < 2) {
            $this->warn('Need at least 2 complete profiles to run matching.');
            return self::FAILURE;
        }

        $this->info("Found {$users->count()} eligible users");

        $pairs     = 0;
        $created   = 0;
        $skipped   = 0;
        $limit     = (int) $this->option('limit');

        $bar = $this->output->createProgressBar($users->count());
        $bar->start();

        foreach ($users as $userA) {
            foreach ($users as $userB) {
                if ($userA->id >= $userB->id) continue; // avoid duplicates + self
                if ($pairs >= $limit) break 2;

                // Check if match already exists
                $exists = UserMatch::where(function ($q) use ($userA, $userB) {
                    $q->where('user_one_id', $userA->id)->where('user_two_id', $userB->id);
                })->orWhere(function ($q) use ($userA, $userB) {
                    $q->where('user_one_id', $userB->id)->where('user_two_id', $userA->id);
                })->where('status', '!=', 'blocked')->exists();

                if ($exists) { $skipped++; continue; }

                // Check gender preferences
                if (!$this->checkGenderPreference($userA, $userB)) { continue; }

                // Calculate all scores
                $quizScore        = $this->calculateQuizScore($userA, $userB);
                $interestScore    = $this->calculateInterestScore($userA, $userB);
                $preferenceScore  = $this->calculatePreferenceScore($userA, $userB);
                $valuesScore      = $this->calculateValuesScore($userA, $userB);
                $locationScore    = $this->calculateLocationScore($userA, $userB);

                // Weighted total
                $total = round(
                    ($quizScore     * $this->weights['quiz'])        / 100 +
                    ($interestScore * $this->weights['interests'])   / 100 +
                    ($preferenceScore * $this->weights['preferences']) / 100 +
                    ($valuesScore   * $this->weights['values'])      / 100 +
                    ($locationScore * $this->weights['location'])    / 100
                );

                // Only create matches above threshold
                if ($total < 30) { continue; }

                UserMatch::create([
                    'user_one_id'        => $userA->id,
                    'user_two_id'        => $userB->id,
                    'compatibility_score'=> $total,
                    'quiz_score'         => $quizScore,
                    'interest_score'     => $interestScore,
                    'preference_score'   => $preferenceScore,
                    'location_score'     => $locationScore,
                    'status'             => 'suggested',
                    'action_by'          => 'system',
                ]);

                // Send notifications
                $this->sendMatchNotification($userA, $userB, $total);
                $this->sendMatchNotification($userB, $userA, $total);

                $created++;
                $pairs++;
            }
            $bar->advance();
        }

        $bar->finish();
        $this->info('');
        $this->info('');
        $this->info("✅ Matchmaking complete!");
        $this->info("   Created: {$created} new matches");
        $this->info("   Skipped: {$skipped} existing pairs");

        return self::SUCCESS;
    }

    // ─── Score Calculators ────────────────────────────────────

    private function calculateQuizScore(User $a, User $b): int
    {
        $answersA = $a->quizAnswers->keyBy('question_id');
        $answersB = $b->quizAnswers->keyBy('question_id');

        if ($answersA->isEmpty() || $answersB->isEmpty()) return 50;

        $shared  = $answersA->keys()->intersect($answersB->keys());
        if ($shared->isEmpty()) return 50;

        $totalWeight  = 0;
        $matchedWeight = 0;

        foreach ($shared as $qId) {
            $ansA     = $answersA[$qId];
            $question = $ansA->question;
            $weight   = $question ? $question->weight : 1;

            $valA = is_array($ansA->answer) ? $ansA->answer : [$ansA->answer];
            $valB = is_array($answersB[$qId]->answer) ? $answersB[$qId]->answer : [$answersB[$qId]->answer];

            $totalWeight += $weight;

            if ($question && $question->type === 'rating_scale') {
                // Score by closeness
                $diff    = abs((int)($valA[0] ?? 0) - (int)($valB[0] ?? 0));
                $maxDiff = 4;
                $matchedWeight += $weight * (1 - ($diff / $maxDiff));
            } elseif ($question && $question->type === 'multiple_choice') {
                $overlap  = count(array_intersect($valA, $valB));
                $union    = count(array_unique(array_merge($valA, $valB)));
                $matchedWeight += $union > 0 ? $weight * ($overlap / $union) : 0;
            } else {
                // Single choice: exact match
                if (!empty(array_intersect($valA, $valB))) {
                    $matchedWeight += $weight;
                }
            }
        }

        return $totalWeight > 0 ? (int) round(($matchedWeight / $totalWeight) * 100) : 50;
    }

    private function calculateInterestScore(User $a, User $b): int
    {
        $interestsA = $a->profile->interests ?? [];
        $interestsB = $b->profile->interests ?? [];

        if (empty($interestsA) || empty($interestsB)) return 40;

        $overlap = count(array_intersect($interestsA, $interestsB));
        $union   = count(array_unique(array_merge($interestsA, $interestsB)));

        return $union > 0 ? (int) round(($overlap / $union) * 100) : 40;
    }

    private function calculatePreferenceScore(User $a, User $b): int
    {
        $score = 0;
        $parts = 0;

        // Age preference
        $ageA = $a->getAge();
        $ageB = $b->getAge();

        if ($ageA && $ageB) {
            $parts++;
            $prefA = ($ageA >= ($b->profile->preferred_age_min ?? 18) && $ageA <= ($b->profile->preferred_age_max ?? 99));
            $prefB = ($ageB >= ($a->profile->preferred_age_min ?? 18) && $ageB <= ($a->profile->preferred_age_max ?? 99));
            if ($prefA && $prefB) $score += 100;
            elseif ($prefA || $prefB) $score += 50;
        }

        // Relationship goals
        $goalA = $a->profile->relationship_goal;
        $goalB = $b->profile->relationship_goal;
        if ($goalA && $goalB) {
            $parts++;
            $score += ($goalA === $goalB) ? 100 : 30;
        }

        return $parts > 0 ? (int) round($score / $parts) : 60;
    }

    private function calculateValuesScore(User $a, User $b): int
    {
        $score = 0;
        $parts = 0;

        $fields = ['smoking', 'drinking', 'has_children', 'wants_children'];

        foreach ($fields as $field) {
            $valA = $a->profile->$field;
            $valB = $b->profile->$field;
            if ($valA && $valB) {
                $parts++;
                $score += ($valA === $valB) ? 100 : 40;
            }
        }

        return $parts > 0 ? (int) round($score / $parts) : 60;
    }

    private function calculateLocationScore(User $a, User $b): int
    {
        $latA  = $a->profile->latitude;
        $lonA  = $a->profile->longitude;
        $latB  = $b->profile->latitude;
        $lonB  = $b->profile->longitude;

        if (!$latA || !$latB) {
            // Same country fallback
            $countryA = $a->profile->country;
            $countryB = $b->profile->country;
            if ($countryA && $countryB) {
                return $countryA === $countryB ? 70 : 40;
            }
            return 50;
        }

        $distance = $this->haversineDistance($latA, $lonA, $latB, $lonB);
        $maxPref  = max($a->profile->preferred_distance_km ?? 100, $b->profile->preferred_distance_km ?? 100);

        if ($distance <= 10)       return 100;
        if ($distance <= 30)       return 90;
        if ($distance <= 50)       return 80;
        if ($distance <= $maxPref) return 70;
        return max(0, (int) round(70 * (1 - ($distance - $maxPref) / 5000)));
    }

    private function haversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $R   = 6371; // Earth radius in km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a   = sin($dLat/2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) ** 2;
        return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    private function checkGenderPreference(User $a, User $b): bool
    {
        $prefA = $a->profile->preferred_gender ?? 'any';
        $prefB = $b->profile->preferred_gender ?? 'any';
        $genA  = $a->profile->gender;
        $genB  = $b->profile->gender;

        $aWantsB = ($prefA === 'any' || $prefA === $genB);
        $bWantsA = ($prefB === 'any' || $prefB === $genA);

        return $aWantsB && $bWantsA;
    }

    private function sendMatchNotification(User $to, User $from, int $score): void
    {
        Notification::create([
            'user_id'      => $to->id,
            'from_user_id' => $from->id,
            'type'         => 'new_match',
            'title'        => 'New Match Found! 💕',
            'message'      => "You and {$from->name} have a {$score}% compatibility score!",
            'icon'         => 'fa-heart',
            'color'        => '#ec4899',
            'action_url'   => route('member.matches'),
        ]);

        // Send email notification
        try {
            $match = UserMatch::where(function ($q) use ($to, $from) {
                $q->where('user_one_id', $to->id)->where('user_two_id', $from->id);
            })->orWhere(function ($q) use ($to, $from) {
                $q->where('user_one_id', $from->id)->where('user_two_id', $to->id);
            })->first();

            if ($match) {
                \Mail::to($to->email)->send(new \App\Mail\MatchNotificationMail($to, $from, $match));
            }
        } catch (\Exception $e) {
            // Don't fail matching if email fails
        }
    }
}