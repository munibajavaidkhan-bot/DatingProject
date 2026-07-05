<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizQuestion;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // Category: Lifestyle & Preferences
            [
                'category' => 'Lifestyle & Preferences',
                'question' => 'How do you prefer to spend your ideal weekend?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Relaxing at home', 'Out with friends', 'Outdoor adventures', 'Trying new restaurants', 'Working on hobbies']),
            ],
            [
                'category' => 'Lifestyle & Preferences',
                'question' => 'How important is physical fitness and health in your life?',
                'type' => 'rating',
                'options' => null,
            ],
            [
                'category' => 'Lifestyle & Preferences',
                'question' => 'What is your stance on pets?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Love them, have/want pets', 'Like them, but dont want any', 'Not a fan', 'Allergic']),
            ],

            // Category: Values & Future
            [
                'category' => 'Values & Future',
                'question' => 'What are you primarily looking for on this platform?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Long-term relationship', 'Marriage', 'Deep friendship', 'Casual dating']),
            ],
            [
                'category' => 'Values & Future',
                'question' => 'How important is career ambition to you in a partner?',
                'type' => 'rating',
                'options' => null,
            ],
            [
                'category' => 'Values & Future',
                'question' => 'Do you see yourself having children in the future?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Yes, definitely', 'Maybe', 'No', 'Already have children']),
            ],

            // Category: Emotional Intelligence
            [
                'category' => 'Emotional Intelligence',
                'question' => 'How do you typically handle conflict in a relationship?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Talk it out immediately', 'Take time to cool off first', 'Avoid it if possible', 'Express through actions']),
            ],
            [
                'category' => 'Emotional Intelligence',
                'question' => 'How important is open communication and vulnerability to you?',
                'type' => 'rating',
                'options' => null,
            ],
            [
                'category' => 'Emotional Intelligence',
                'question' => 'Which of these "Love Languages" resonates most with you?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Words of Affirmation', 'Acts of Service', 'Receiving Gifts', 'Quality Time', 'Physical Touch']),
            ],

            // Category: Personality
            [
                'category' => 'Personality',
                'question' => 'How would you describe your social energy?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Extroverted', 'Introverted', 'Ambiverted']),
            ],
            [
                'category' => 'Personality',
                'question' => 'Are you more of a spontaneous person or a planner?',
                'type' => 'rating',
                'options' => null, // 1: Pure Planner, 5: Pure Spontaneous
            ],
        ];

        foreach ($questions as $q) {
            QuizQuestion::create($q);
        }
    }
}