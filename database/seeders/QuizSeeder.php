<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizQuestion;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Purane questions delete kar dein, taaki naye categories ke saath load ho
        DB::table('quiz_questions')->delete(); 
        echo "Seeding 23 Dynamic Quiz Questions with Categories...\n";

        // --- QUESTIONNAIRE 1: Relationship Personality Assessment (Q1) ---
        
        $cat1 = 'QUESTIONNAIRE 1: Relationship Personality Assessment';

        // 1. Reason for joining (Multiple Choice)
        QuizQuestion::create([
            'category' => $cat1,
            'question' => 'What is your primary reason for joining the 52 Week Love project?',
            'type' => 'multiple_choice',
            'options' => json_encode(['Long-term relationship', 'Meaningful dating', 'Companionship with potential', 'Exploring options']),
        ]);

        // 2. Communication style (Multiple Choice)
        QuizQuestion::create([
            'category' => $cat1,
            'question' => 'Which best describes your communication style?',
            'type' => 'multiple_choice',
            'options' => json_encode(['Direct and honest', 'Soft and thoughtful', 'Balanced', 'Reserved']),
        ]);

        // 3. Preferred connection (Multiple Choice)
        QuizQuestion::create([
            'category' => $cat1,
            'question' => 'Which connection type do you prefer to develop first?',
            'type' => 'multiple_choice',
            'options' => json_encode(['Emotional first', 'Physical first', 'Balanced', 'Intellectual']),
        ]);

        // 4. Conflict handling (Multiple Choice)
        QuizQuestion::create([
            'category' => $cat1,
            'question' => 'How do you prefer to handle conflict in a relationship?',
            'type' => 'multiple_choice',
            'options' => json_encode(['Immediate discussion', 'Delayed communication', 'Avoidance', 'Structured approach']),
        ]);

        // 5. Top non-negotiables (Multiselect - Select up to 3)
        QuizQuestion::create([
            'category' => $cat1,
            'question' => 'Select your top 3 non-negotiables in a partner:',
            'type' => 'multiselect',
            'options' => json_encode(['Hygiene', 'Emotional maturity', 'Financial stability', 'Communication consistency', 'Respect and loyalty', 'Ambition']),
        ]);

        // --- QUESTIONNAIRE 2: Emotional Compatibility Assessment (Q2) ---
        
        $cat2 = 'QUESTIONNAIRE 2: Emotional Compatibility Assessment';

        // 1. How do you express affection? (Multiselect)
        QuizQuestion::create([
            'category' => $cat2,
            'question' => 'How do you primarily express affection?',
            'type' => 'multiselect',
            'options' => json_encode(['Verbal', 'Physical touch', 'Quality time', 'Acts of service', 'Experiences']),
        ]);

        // 2. What affection do you expect? (Multiselect)
        QuizQuestion::create([
            'category' => $cat2,
            'question' => 'What type of affection do you most expect from a partner?',
            'type' => 'multiselect',
            'options' => json_encode(['Verbal reassurance', 'Consistent presence', 'Physical intimacy', 'Practical support', 'Emotional depth']),
        ]);

        // 3. Dating expectations (Multiple Choice)
        QuizQuestion::create([
            'category' => $cat2,
            'question' => 'What are your dating expectations regarding pace?',
            'type' => 'multiple_choice',
            'options' => json_encode(['Slow and steady', 'Fast connection', 'Balanced progress', 'Chemistry first']),
        ]);

        // 4. Important values (Multiselect - Choose up to 4)
        QuizQuestion::create([
            'category' => $cat2,
            'question' => 'Select up to 4 values that are most important to you:',
            'type' => 'multiselect',
            'options' => json_encode(['Honesty', 'Emotional availability', 'Independence', 'Ambition', 'Family orientation', 'Stability', 'Kindness']),
        ]);

        // 5. Preferred lifestyle (Multiple Choice)
        QuizQuestion::create([
            'category' => $cat2,
            'question' => 'Which preferred lifestyle best matches yours?',
            'type' => 'multiple_choice',
            'options' => json_encode(['Calm, home-focused', 'Adventurous', 'Balanced', 'Social']),
        ]);

        // 6. Deal-breakers (Multiselect)
        QuizQuestion::create([
            'category' => $cat2,
            'question' => 'What are your absolute deal-breakers?',
            'type' => 'multiselect',
            'options' => json_encode(['Dishonesty', 'Poor communication', 'Lack of ambition', 'Emotional baggage', 'Hygiene issues', 'Financial irresponsibility']),
        ]);


        // --- QUESTIONNAIRE 3: The 12C Compatibility Filter (Q3 - Rating Scale 1-5) ---
        
        $cat3 = 'QUESTIONNAIRE 3: The 12C Compatibility Filter';
        
        $c_questions = [
            'Cute (Physical Attraction)', 'Cash (Financial Comfort)', 'Car (Mobility/Status)',
            'Condo (Living Situation)', 'Cook (Culinary Skills)', 'Clean (Tidiness)',
            'Connection (Emotional Bond)', 'Communication (Openness)', 'Credit Score (Financial Responsibility)',
            'Commitment (Desire for Future)', 'Creativity (Hobbies/Expression)', 'Chemistry (Spark/Intimacy)'
        ];

        foreach ($c_questions as $c_q) {
            QuizQuestion::create([
                'category' => $cat3,
                'question' => "Rate the importance of '{$c_q}' in a potential partner (1-5):",
                'type' => 'rating',
                'options' => null, 
            ]);
        }

        echo "Seeding Complete. Total questions: " . QuizQuestion::count() . "\n";
    }
}