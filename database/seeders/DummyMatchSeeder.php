<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\Hash;

class DummyMatchSeeder extends Seeder
{
    public function run(): void
    {
        $questions = QuizQuestion::all();
        
        $names = ['Aarav', 'Zoya', 'Ishaan', 'Sana', 'Kabir', 'Ananya'];
        
        foreach ($names as $name) {
            $user = User::create([
                'name' => $name,
                'email' => strtolower($name) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'gender' => $name === 'Zoya' || $name === 'Sana' || $name === 'Ananya' ? 'Female' : 'Male',
                'location' => 'Dubai, UAE',
            ]);

            foreach ($questions as $q) {
                $options = $q->options ? json_decode($q->options, true) : null;
                
                if ($q->type === 'rating') {
                    $answer = rand(3, 5); // Mostly positive for better matches
                } else {
                    $answer = $options[array_rand($options)];
                }

                QuizAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $q->id,
                    'answer' => $answer,
                ]);
            }
        }
    }
}
