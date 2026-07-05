<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Database\Seeder;

class QuizAnswersSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $questions = QuizQuestion::all();
        $count = 0;

        foreach ($users as $user) {
            foreach ($questions as $q) {
                if (in_array($q->type, ['rating', 'rating_scale'])) {
                    $answer = [(string) rand(1, 5)];
                } elseif ($q->options) {
                    $opts = is_array($q->options) ? $q->options : json_decode($q->options, true);
                    $answer = is_array($opts) && count($opts) ? [$opts[array_rand($opts)]] : ['Option 1'];
                } else {
                    $answer = ['Sample answer'];
                }

                QuizAnswer::updateOrCreate(
                    ['user_id' => $user->id, 'question_id' => $q->id],
                    ['answer' => $answer]
                );
                $count++;
            }
        }

        $this->command->info("Created {$count} quiz answers for {$users->count()} users!");
    }
}