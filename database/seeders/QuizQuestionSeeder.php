<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuizQuestion;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing questions (delete instead of truncate due to foreign key)
        QuizQuestion::query()->delete();

        // QUESTIONNAIRE 1: Relationship Personality Assessment
        $personalityQuestions = [
            [
                'question' => 'What is your reason for joining this platform?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Long-term relationship', 'Meaningful dating', 'Companionship with potential', 'Exploring options']),
                'category' => 'Personality Assessment'
            ],
            [
                'question' => 'How would you describe your communication style?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Direct and honest', 'Soft and thoughtful', 'Balanced', 'Reserved']),
                'category' => 'Personality Assessment'
            ],
            [
                'question' => 'What type of connection do you prefer?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Emotional first', 'Physical first', 'Balanced', 'Intellectual']),
                'category' => 'Personality Assessment'
            ],
            [
                'question' => 'How do you handle conflicts in relationships?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Immediate discussion', 'Delayed communication', 'Avoidance', 'Structured approach']),
                'category' => 'Personality Assessment'
            ],
            [
                'question' => 'Select your top 3 non-negotiable qualities in a partner:',
                'type' => 'multiselect',
                'options' => json_encode(['Hygiene', 'Emotional maturity', 'Financial stability', 'Communication consistency', 'Respect and loyalty', 'Ambition']),
                'category' => 'Personality Assessment'
            ]
        ];

        // QUESTIONNAIRE 2: Emotional Compatibility Assessment
        $emotionalQuestions = [
            [
                'question' => 'How do you prefer to express affection?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Verbal reassurance', 'Physical touch', 'Quality time', 'Acts of service', 'Shared experiences']),
                'category' => 'Emotional Compatibility'
            ],
            [
                'question' => 'What kind of affection do you expect from a partner?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Verbal reassurance', 'Consistent presence', 'Physical intimacy', 'Practical support', 'Emotional depth']),
                'category' => 'Emotional Compatibility'
            ],
            [
                'question' => 'What are your dating expectations?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Slow and steady', 'Fast connection', 'Balanced progress', 'Chemistry first']),
                'category' => 'Emotional Compatibility'
            ],
            [
                'question' => 'Choose up to 4 values that are most important to you:',
                'type' => 'multiselect',
                'options' => json_encode(['Honesty', 'Emotional availability', 'Independence', 'Ambition', 'Family orientation', 'Stability', 'Kindness']),
                'category' => 'Emotional Compatibility'
            ],
            [
                'question' => 'What lifestyle do you prefer?',
                'type' => 'multiple_choice',
                'options' => json_encode(['Calm, home-focused', 'Adventurous', 'Balanced', 'Social']),
                'category' => 'Emotional Compatibility'
            ],
            [
                'question' => 'What are your deal-breakers? (Select all that apply)',
                'type' => 'multiselect',
                'options' => json_encode(['Dishonesty', 'Poor communication', 'Lack of ambition', 'Emotional baggage', 'Hygiene issues', 'Financial irresponsibility']),
                'category' => 'Emotional Compatibility'
            ]
        ];

        // QUESTIONNAIRE 3: The 12C Compatibility Filter
        $compatibilityQuestions = [];
        $cFactors = ['Cute', 'Cash', 'Car', 'Condo', 'Cook', 'Clean', 'Connection', 'Communication', 'Credit Score', 'Commitment', 'Creativity', 'Chemistry'];
        
        foreach ($cFactors as $factor) {
            $compatibilityQuestions[] = [
                'question' => "How important is '{$factor}' to you in a partner?",
                'type' => 'rating',
                'options' => null,
                'category' => '12C Compatibility Filter'
            ];
        }

        // MINI QUIZ: Ten-Second Starter
        $miniQuizQuestions = [
            [
                'question' => 'Pick your perfect first date:',
                'type' => 'multiple_choice',
                'options' => json_encode(['Coffee conversation', 'Nice dinner', 'Scenic walk', 'Fun activity', 'Relaxed hangout']),
                'category' => 'Quick Start Quiz'
            ],
            [
                'question' => 'Your texting style:',
                'type' => 'multiple_choice',
                'options' => json_encode(['Fast replies', 'Slow paced', 'Meme-based', 'Long messages']),
                'category' => 'Quick Start Quiz'
            ],
            [
                'question' => 'Your biggest dating ick:',
                'type' => 'multiple_choice',
                'options' => json_encode(['Bad hygiene', 'Low effort', 'Poor communication', 'Emotional unavailability']),
                'category' => 'Quick Start Quiz'
            ]
        ];

        // DATER TYPE SELECTION
        $daterTypeQuestion = [
            [
                'question' => 'What kind of dater are you?',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'The Analyzer: "I need personality, depth, and someone who actually communicates."',
                    'The Romantic: "I\'m looking for chemistry, emotional warmth, and genuine connection."',
                    'The Chaos Survivor: "I have endless stories; now I\'m ready for someone stable."',
                    'The Serious One: "I\'m here for a real relationship with emotional maturity."'
                ]),
                'category' => 'Dater Type'
            ]
        ];

        // VIBE SELECTION
        $vibeQuestions = [
            [
                'question' => 'Tell us your vibe and we will find your tribe:',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'I want someone who makes me laugh.',
                    'I want meaningful conversations.',
                    'I want adventure and spontaneity.',
                    'I want emotional stability.',
                    'I want a partner, not a project.'
                ]),
                'category' => 'Vibe Selection'
            ],
            [
                'question' => 'Choose the statement that feels most like you:',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'Warm and thoughtful',
                    'Calm and selective',
                    'Confident and bold',
                    'Deep and introspective',
                    'Playful and energetic'
                ]),
                'category' => 'Personality Type'
            ]
        ];

        // Combine all questions
        $allQuestions = array_merge(
            $daterTypeQuestion,
            $vibeQuestions,
            $miniQuizQuestions,
            $personalityQuestions,
            $emotionalQuestions,
            $compatibilityQuestions
        );

        foreach ($allQuestions as $question) {
            QuizQuestion::create($question);
        }
    }
}
