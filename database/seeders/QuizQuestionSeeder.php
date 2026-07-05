<?php

namespace Database\Seeders;

// database/seeders/QuizQuestionSeeder.php

use Illuminate\Database\Seeder;
use App\Models\QuizQuestion;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        QuizQuestion::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $questions = [
            // ── PERSONALITY (6 questions) ──────────────────────
            [
                'question' => 'How do you usually recharge after a long week?',
                'category' => 'personality',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Spend time alone with a book or movie'],
                    ['value' => 'b', 'label' => 'Go out with a group of friends'],
                    ['value' => 'c', 'label' => 'Have a quiet dinner with one close person'],
                    ['value' => 'd', 'label' => 'Do something active outdoors'],
                ],
                'weight' => 3, 'sort_order' => 1,
            ],
            [
                'question' => 'Which best describes your communication style?',
                'category' => 'personality',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Direct and to the point'],
                    ['value' => 'b', 'label' => 'Empathetic and feeling-focused'],
                    ['value' => 'c', 'label' => 'Thoughtful and detail-oriented'],
                    ['value' => 'd', 'label' => 'Flexible and go with the flow'],
                ],
                'weight' => 3, 'sort_order' => 2,
            ],
            [
                'question' => 'How do you handle conflict in a relationship?',
                'category' => 'personality',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Address it immediately and directly'],
                    ['value' => 'b', 'label' => 'Take time to cool down, then talk'],
                    ['value' => 'c', 'label' => 'Seek compromise and middle ground'],
                    ['value' => 'd', 'label' => 'Prefer to let small things go'],
                ],
                'weight' => 4, 'sort_order' => 3,
            ],
            [
                'question' => 'Your ideal Saturday looks like:',
                'category' => 'personality',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Hiking or outdoor adventure'],
                    ['value' => 'b', 'label' => 'Visiting museums or galleries'],
                    ['value' => 'c', 'label' => 'Cooking a meal and hosting friends'],
                    ['value' => 'd', 'label' => 'Lazy day at home, movies and snacks'],
                ],
                'weight' => 2, 'sort_order' => 4,
            ],
            [
                'question' => 'How important is physical affection to you?',
                'category' => 'personality',
                'type'     => 'rating_scale',
                'options'  => [
                    ['value' => '1', 'label' => 'Not important at all'],
                    ['value' => '2', 'label' => 'Slightly important'],
                    ['value' => '3', 'label' => 'Moderately important'],
                    ['value' => '4', 'label' => 'Very important'],
                    ['value' => '5', 'label' => 'Extremely important'],
                ],
                'weight' => 3, 'sort_order' => 5,
            ],
            [
                'question' => 'When meeting someone new, you typically:',
                'category' => 'personality',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Open up quickly and share freely'],
                    ['value' => 'b', 'label' => 'Take time to trust before opening up'],
                    ['value' => 'c', 'label' => 'Ask lots of questions about them'],
                    ['value' => 'd', 'label' => 'Let them lead the conversation'],
                ],
                'weight' => 2, 'sort_order' => 6,
            ],

            // ── VALUES (5 questions) ───────────────────────────
            [
                'question' => 'What is most important to you in a partner?',
                'category' => 'values',
                'type'     => 'multiple_choice',
                'options'  => [
                    ['value' => 'loyalty',      'label' => 'Loyalty and honesty'],
                    ['value' => 'ambition',     'label' => 'Ambition and drive'],
                    ['value' => 'kindness',     'label' => 'Kindness and empathy'],
                    ['value' => 'humor',        'label' => 'Sense of humor'],
                    ['value' => 'intelligence', 'label' => 'Intelligence and wisdom'],
                    ['value' => 'stability',    'label' => 'Emotional stability'],
                ],
                'weight' => 5, 'sort_order' => 7,
            ],
            [
                'question' => 'How do you feel about religion/spirituality?',
                'category' => 'values',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Very important — faith guides my life'],
                    ['value' => 'b', 'label' => 'Somewhat important — I am spiritual'],
                    ['value' => 'c', 'label' => 'Not very important personally'],
                    ['value' => 'd', 'label' => 'I am not religious or spiritual'],
                ],
                'weight' => 4, 'sort_order' => 8,
            ],
            [
                'question' => 'Your view on finances in a relationship:',
                'category' => 'values',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Everything shared equally (joint accounts)'],
                    ['value' => 'b', 'label' => 'Split bills, keep some separate savings'],
                    ['value' => 'c', 'label' => 'One person manages finances'],
                    ['value' => 'd', 'label' => 'Completely separate, split expenses'],
                ],
                'weight' => 3, 'sort_order' => 9,
            ],
            [
                'question' => 'How do you feel about having children?',
                'category' => 'values',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Definitely want children'],
                    ['value' => 'b', 'label' => 'Open to it but not certain'],
                    ['value' => 'c', 'label' => 'Do not want children'],
                    ['value' => 'd', 'label' => 'Already have children'],
                ],
                'weight' => 5, 'sort_order' => 10,
            ],
            [
                'question' => 'Political and social views in a partner:',
                'category' => 'values',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Must share my exact views'],
                    ['value' => 'b', 'label' => 'Should be generally aligned'],
                    ['value' => 'c', 'label' => 'Differences are fine if we respect each other'],
                    ['value' => 'd', 'label' => 'Politics should stay out of relationships'],
                ],
                'weight' => 3, 'sort_order' => 11,
            ],

            // ── LIFESTYLE (5 questions) ────────────────────────
            [
                'question' => 'How active is your lifestyle?',
                'category' => 'lifestyle',
                'type'     => 'rating_scale',
                'options'  => [
                    ['value' => '1', 'label' => 'Very sedentary (mostly indoors)'],
                    ['value' => '2', 'label' => 'Lightly active (occasional walks)'],
                    ['value' => '3', 'label' => 'Moderately active (gym 2-3x week)'],
                    ['value' => '4', 'label' => 'Very active (daily workouts)'],
                    ['value' => '5', 'label' => 'Extremely active (athlete level)'],
                ],
                'weight' => 3, 'sort_order' => 12,
            ],
            [
                'question' => 'How important is travel to you?',
                'category' => 'lifestyle',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Travel is my passion — I go often'],
                    ['value' => 'b', 'label' => 'I enjoy occasional trips'],
                    ['value' => 'c', 'label' => 'I prefer staycations mostly'],
                    ['value' => 'd', 'label' => 'Travel is not a priority for me'],
                ],
                'weight' => 2, 'sort_order' => 13,
            ],
            [
                'question' => 'Your relationship with social media:',
                'category' => 'lifestyle',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Very active — post daily'],
                    ['value' => 'b', 'label' => 'Moderately active — browse often'],
                    ['value' => 'c', 'label' => 'Rarely use it'],
                    ['value' => 'd', 'label' => 'Not on social media'],
                ],
                'weight' => 1, 'sort_order' => 14,
            ],
            [
                'question' => 'What does a typical weekday evening look like for you?',
                'category' => 'lifestyle',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Working late or pursuing career goals'],
                    ['value' => 'b', 'label' => 'Working out, hobbies, or classes'],
                    ['value' => 'c', 'label' => 'Relaxing at home (TV, reading)'],
                    ['value' => 'd', 'label' => 'Socializing with friends or family'],
                ],
                'weight' => 2, 'sort_order' => 15,
            ],
            [
                'question' => 'Your stance on living arrangements after commitment:',
                'category' => 'lifestyle',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Move in together as soon as possible'],
                    ['value' => 'b', 'label' => 'Live together before marriage'],
                    ['value' => 'c', 'label' => 'Wait until marriage to live together'],
                    ['value' => 'd', 'label' => 'Prefer maintaining separate homes'],
                ],
                'weight' => 3, 'sort_order' => 16,
            ],

            // ── RELATIONSHIP GOALS (5 questions) ──────────────
            [
                'question' => 'What are you primarily looking for right now?',
                'category' => 'relationship_goals',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Marriage and long-term commitment'],
                    ['value' => 'b', 'label' => 'A serious relationship (not rushing marriage)'],
                    ['value' => 'c', 'label' => 'Casual dating to see what happens'],
                    ['value' => 'd', 'label' => 'Friendship first, see where it goes'],
                ],
                'weight' => 5, 'sort_order' => 17,
            ],
            [
                'question' => 'How long are you willing to do long-distance?',
                'category' => 'relationship_goals',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'I would not do long-distance'],
                    ['value' => 'b', 'label' => 'Short-term only (under 6 months)'],
                    ['value' => 'c', 'label' => 'Up to a year if we have a plan'],
                    ['value' => 'd', 'label' => 'As long as it takes to be together'],
                ],
                'weight' => 3, 'sort_order' => 18,
            ],
            [
                'question' => 'How important is a partner sharing your hobbies?',
                'category' => 'relationship_goals',
                'type'     => 'rating_scale',
                'options'  => [
                    ['value' => '1', 'label' => 'Not at all — I like my own space'],
                    ['value' => '2', 'label' => 'Slightly — a few shared interests is nice'],
                    ['value' => '3', 'label' => 'Moderately — some overlap is good'],
                    ['value' => '4', 'label' => 'Very — we should enjoy many things together'],
                    ['value' => '5', 'label' => 'Completely — shared life = shared hobbies'],
                ],
                'weight' => 3, 'sort_order' => 19,
            ],
            [
                'question' => 'How often do you expect to communicate with a partner?',
                'category' => 'relationship_goals',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Constantly — texts throughout the day'],
                    ['value' => 'b', 'label' => 'Frequently — morning and evening check-ins'],
                    ['value' => 'c', 'label' => 'Moderate — when something worth sharing happens'],
                    ['value' => 'd', 'label' => 'Minimal — I value independence'],
                ],
                'weight' => 4, 'sort_order' => 20,
            ],
            [
                'question' => 'How do you feel about meeting a partner\'s family early on?',
                'category' => 'relationship_goals',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Love it — family approval is important'],
                    ['value' => 'b', 'label' => 'Fine with it after a few months'],
                    ['value' => 'c', 'label' => 'Prefer to wait until things are serious'],
                    ['value' => 'd', 'label' => 'Family involvement is not a priority'],
                ],
                'weight' => 3, 'sort_order' => 21,
            ],

            // ── COMMUNICATION (4 questions) ────────────────────
            [
                'question' => 'How do you prefer to receive appreciation?',
                'category' => 'communication',
                'type'     => 'multiple_choice',
                'options'  => [
                    ['value' => 'words',   'label' => 'Words of affirmation (compliments, "I love you")'],
                    ['value' => 'acts',    'label' => 'Acts of service (help, doing things for you)'],
                    ['value' => 'gifts',   'label' => 'Thoughtful gifts'],
                    ['value' => 'time',    'label' => 'Quality time together'],
                    ['value' => 'touch',   'label' => 'Physical touch'],
                ],
                'weight' => 4, 'sort_order' => 22,
            ],
            [
                'question' => 'In arguments, you tend to:',
                'category' => 'communication',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Stand firm until resolved'],
                    ['value' => 'b', 'label' => 'Step back and return when calm'],
                    ['value' => 'c', 'label' => 'Look for a compromise quickly'],
                    ['value' => 'd', 'label' => 'Avoid arguments — prefer written communication'],
                ],
                'weight' => 4, 'sort_order' => 23,
            ],
            [
                'question' => 'How transparent are you about your past?',
                'category' => 'communication',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Very open — I share everything'],
                    ['value' => 'b', 'label' => 'Open about most things gradually'],
                    ['value' => 'c', 'label' => 'Share what is relevant only'],
                    ['value' => 'd', 'label' => 'Private — past is past'],
                ],
                'weight' => 3, 'sort_order' => 24,
            ],
            [
                'question' => 'How do you handle jealousy?',
                'category' => 'communication',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Rarely feel it — I trust fully'],
                    ['value' => 'b', 'label' => 'Talk about it calmly when I do'],
                    ['value' => 'c', 'label' => 'Try to manage it on my own'],
                    ['value' => 'd', 'label' => 'It comes up — I am working on it'],
                ],
                'weight' => 3, 'sort_order' => 25,
            ],

            // ── INTERESTS (4 questions) ────────────────────────
            [
                'question' => 'Which of these best describes your taste in music?',
                'category' => 'interests',
                'type'     => 'multiple_choice',
                'options'  => [
                    ['value' => 'pop',       'label' => 'Pop / Top 40'],
                    ['value' => 'rock',      'label' => 'Rock / Alternative'],
                    ['value' => 'rnb',       'label' => 'R&B / Soul'],
                    ['value' => 'classical', 'label' => 'Classical / Jazz'],
                    ['value' => 'hiphop',    'label' => 'Hip Hop / Rap'],
                    ['value' => 'electronic','label' => 'Electronic / EDM'],
                    ['value' => 'country',   'label' => 'Country / Folk'],
                    ['value' => 'world',     'label' => 'World Music'],
                ],
                'weight' => 1, 'sort_order' => 26,
            ],
            [
                'question' => 'Select your top hobbies (choose all that apply):',
                'category' => 'interests',
                'type'     => 'multiple_choice',
                'options'  => [
                    ['value' => 'fitness',     'label' => 'Fitness & Sports'],
                    ['value' => 'cooking',     'label' => 'Cooking & Food'],
                    ['value' => 'travel',      'label' => 'Travel & Adventure'],
                    ['value' => 'reading',     'label' => 'Reading & Writing'],
                    ['value' => 'art',         'label' => 'Art & Creativity'],
                    ['value' => 'gaming',      'label' => 'Gaming'],
                    ['value' => 'nature',      'label' => 'Nature & Outdoors'],
                    ['value' => 'music',       'label' => 'Music & Concerts'],
                    ['value' => 'movies',      'label' => 'Movies & TV Shows'],
                    ['value' => 'volunteering','label' => 'Volunteering & Causes'],
                ],
                'weight' => 3, 'sort_order' => 27,
            ],
            [
                'question' => 'Date night preference?',
                'category' => 'interests',
                'type'     => 'single_choice',
                'options'  => [
                    ['value' => 'a', 'label' => 'Fine dining and dressing up'],
                    ['value' => 'b', 'label' => 'Casual coffee or picnic in the park'],
                    ['value' => 'c', 'label' => 'Adventure activity (hiking, escape room)'],
                    ['value' => 'd', 'label' => 'Cozy night in with home-cooked meal'],
                ],
                'weight' => 2, 'sort_order' => 28,
            ],
            [
                'question' => 'How often do you enjoy trying new things?',
                'category' => 'interests',
                'type'     => 'rating_scale',
                'options'  => [
                    ['value' => '1', 'label' => 'Rarely — I love my routines'],
                    ['value' => '2', 'label' => 'Sometimes — if it is not too wild'],
                    ['value' => '3', 'label' => 'Often — I enjoy new experiences'],
                    ['value' => '4', 'label' => 'Very often — I seek novelty'],
                    ['value' => '5', 'label' => 'Always — I crave adventure'],
                ],
                'weight' => 2, 'sort_order' => 29,
            ],
        ];

        foreach ($questions as $q) {
            QuizQuestion::create($q);
        }

        $this->command->info('✅ 29 quiz questions seeded across 6 categories');
    }
}