<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function welcome()
    {
        $user          = Auth::user();
        $answeredCount = QuizAnswer::where('user_id', $user->id)->count();
        $totalCount    = QuizQuestion::where('is_active', true)->count();
        $isCompleted   = $user->hasCompletedQuiz();

        return view('user.quiz-welcome', compact('user', 'answeredCount', 'totalCount', 'isCompleted'));
    }

    public function start()
    {
        $user = Auth::user();

        // Find first unanswered question
        $answeredIds = QuizAnswer::where('user_id', $user->id)
            ->pluck('question_id');

        $question = QuizQuestion::where('is_active', true)
            ->whereNotIn('id', $answeredIds)
            ->orderBy('sort_order')
            ->first();

        // All done
        if (!$question) {
            return redirect()->route('member.quiz.results');
        }

        $totalCount    = QuizQuestion::where('is_active', true)->count();
        $answeredCount = $answeredIds->count();
        $progress      = $totalCount > 0 ? round(($answeredCount / $totalCount) * 100) : 0;

        // Group questions by category for progress display
        $categories = QuizQuestion::where('is_active', true)
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->get();

        $answeredByCategory = QuizAnswer::where('user_id', $user->id)
            ->join('quiz_questions', 'quiz_answers.question_id', '=', 'quiz_questions.id')
            ->selectRaw('quiz_questions.category, count(*) as answered')
            ->groupBy('quiz_questions.category')
            ->pluck('answered', 'category');

        return view('user.quiz', compact(
            'question', 'totalCount', 'answeredCount',
            'progress', 'categories', 'answeredByCategory'
        ));
    }

    public function saveAnswer(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'exists:quiz_questions,id'],
            'answer'      => ['required'],
        ]);

        $user     = Auth::user();
        $question = QuizQuestion::findOrFail($request->question_id);

        $answer = $request->answer;
        if (!is_array($answer)) {
            $answer = [$answer];
        }

        QuizAnswer::updateOrCreate(
            ['user_id' => $user->id, 'question_id' => $request->question_id],
            ['answer' => $answer, 'score' => $this->calculateAnswerScore($question, $answer)]
        );

        // Check if quiz is complete
        $totalCount    = QuizQuestion::where('is_active', true)->count();
        $answeredCount = QuizAnswer::where('user_id', $user->id)->count();

        if ($answeredCount >= $totalCount) {
            // Determine personality type
            $this->determinePersonalityType($user);
            return response()->json(['redirect' => route('member.quiz.results')]);
        }

        return response()->json(['success' => true, 'answered' => $answeredCount, 'total' => $totalCount]);
    }

    public function results()
    {
        $user    = Auth::user();
        $answers = QuizAnswer::where('user_id', $user->id)
            ->with('question')
            ->get();

        if ($answers->isEmpty()) {
            return redirect()->route('member.quiz')->with('info', 'Please take the quiz first.');
        }

        $totalQuestions = QuizQuestion::where('is_active', true)->count();
        $completionPct  = round(($answers->count() / $totalQuestions) * 100);

        // Category scores
        $categoryScores = $this->calculateCategoryScores($answers);

        // Personality type
        $personalityType = $user->profile?->personality_type ?? $this->determinePersonalityType($user);

        // Top traits
        $topTraits = $this->getTopTraits($categoryScores);

        return view('user.quiz-results', compact(
            'user', 'answers', 'categoryScores',
            'personalityType', 'topTraits', 'completionPct'
        ));
    }

    // ─── Private Helpers ─────────────────────────────────────

    private function calculateAnswerScore(QuizQuestion $question, array $answer): int
    {
        if ($question->type === 'rating_scale') {
            return (int)($answer[0] ?? 3) * 20; // 1-5 → 20-100
        }
        return 50; // default
    }

    private function calculateCategoryScores($answers): array
    {
        $categories = [];
        foreach ($answers as $answer) {
            $cat = $answer->question?->category ?? 'other';
            if (!isset($categories[$cat])) {
                $categories[$cat] = ['total' => 0, 'count' => 0];
            }
            $categories[$cat]['total'] += $answer->score;
            $categories[$cat]['count']++;
        }

        $scores = [];
        foreach ($categories as $cat => $data) {
            $scores[$cat] = $data['count'] > 0
                ? min(100, round($data['total'] / $data['count']))
                : 50;
        }
        return $scores;
    }

    private function determinePersonalityType(object $user): string
    {
        $answers = QuizAnswer::where('user_id', $user->id)->with('question')->get();

        $scores = $this->calculateCategoryScores($answers);

        $maxCategory = collect($scores)->sortDesc()->keys()->first() ?? 'personality';

        $types = [
            'personality'        => 'The Heartfelt Romantic',
            'values'             => 'The Principled Partner',
            'lifestyle'          => 'The Free Spirit',
            'relationship_goals' => 'The Intentional Lover',
            'communication'      => 'The Deep Connector',
            'interests'          => 'The Curious Soul',
        ];

        $type = $types[$maxCategory] ?? 'The Authentic Heart';

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            ['personality_type' => $type, 'quiz_score' => (int) round(collect($scores)->avg())]
        );

        return $type;
    }

    private function getTopTraits(array $scores): array
    {
        $traits = [
            'personality'        => ['label' => 'Emotional Depth',    'icon' => 'fa-heart'],
            'values'             => ['label' => 'Core Values',         'icon' => 'fa-star'],
            'lifestyle'          => ['label' => 'Life Balance',        'icon' => 'fa-leaf'],
            'relationship_goals' => ['label' => 'Relationship Vision', 'icon' => 'fa-compass'],
            'communication'      => ['label' => 'Communication',       'icon' => 'fa-comments'],
            'interests'          => ['label' => 'Shared Interests',    'icon' => 'fa-puzzle-piece'],
        ];

        $result = [];
        foreach ($scores as $cat => $score) {
            if (isset($traits[$cat])) {
                $result[] = array_merge($traits[$cat], ['score' => $score, 'category' => $cat]);
            }
        }

        usort($result, fn($a, $b) => $b['score'] - $a['score']);
        return array_slice($result, 0, 4);
    }
}