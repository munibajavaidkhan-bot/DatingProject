<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class SampleUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'user' => [
                    'name' => 'Sarah Johnson', 'email' => 'sarah@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'female', 'dob' => '1995-03-15',
                    'location' => 'New York, USA',
                ],
                'profile' => [
                    'first_name' => 'Sarah', 'last_name' => 'Johnson',
                    'date_of_birth' => '1995-03-15', 'gender' => 'female',
                    'city' => 'New York', 'country' => 'USA',
                    'bio' => 'I love hiking, reading, and cooking. Looking for a genuine connection with someone who values family and adventure.',
                    'occupation' => 'Graphic Designer', 'education' => 'bachelors',
                    'relationship_goal' => 'long_term',
                    'interests' => ['hiking', 'reading', 'cooking', 'photography', 'travel'],
                    'personality_type' => 'Creative Soul',
                    'preferred_gender' => 'male', 'preferred_age_min' => 25, 'preferred_age_max' => 38,
                    'is_complete' => true, 'is_verified' => true,
                    'height' => 165, 'body_type' => 'athletic',
                    'smoking' => 'never', 'drinking' => 'occasionally',
                    'religion' => 'christian',
                ],
            ],
            [
                'user' => [
                    'name' => 'Michael Chen', 'email' => 'michael@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'male', 'dob' => '1992-07-22',
                    'location' => 'San Francisco, USA',
                ],
                'profile' => [
                    'first_name' => 'Michael', 'last_name' => 'Chen',
                    'date_of_birth' => '1992-07-22', 'gender' => 'male',
                    'city' => 'San Francisco', 'country' => 'USA',
                    'bio' => 'Software engineer by day, amateur chef by night. I believe in meaningful conversations and genuine connections.',
                    'occupation' => 'Software Engineer', 'education' => 'masters',
                    'relationship_goal' => 'marriage',
                    'interests' => ['cooking', 'coding', 'music', 'travel', 'fitness'],
                    'personality_type' => 'Analytical Heart',
                    'preferred_gender' => 'female', 'preferred_age_min' => 24, 'preferred_age_max' => 35,
                    'is_complete' => true, 'is_verified' => true,
                    'height' => 178, 'body_type' => 'athletic',
                    'smoking' => 'never', 'drinking' => 'socially',
                    'religion' => 'buddhist',
                ],
            ],
            [
                'user' => [
                    'name' => 'Emma Wilson', 'email' => 'emma@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'female', 'dob' => '1997-11-08',
                    'location' => 'London, UK',
                ],
                'profile' => [
                    'first_name' => 'Emma', 'last_name' => 'Wilson',
                    'date_of_birth' => '1997-11-08', 'gender' => 'female',
                    'city' => 'London', 'country' => 'UK',
                    'bio' => 'Passionate about art, yoga, and sustainable living. Seeking a partner who shares my love for personal growth and adventure.',
                    'occupation' => 'Art Teacher', 'education' => 'bachelors',
                    'relationship_goal' => 'long_term',
                    'interests' => ['art', 'yoga', 'sustainability', 'meditation', 'travel'],
                    'personality_type' => 'Free Spirit',
                    'preferred_gender' => 'male', 'preferred_age_min' => 26, 'preferred_age_max' => 38,
                    'is_complete' => true, 'is_verified' => false,
                    'height' => 168, 'body_type' => 'slim',
                    'smoking' => 'never', 'drinking' => 'never',
                    'religion' => 'atheist',
                ],
            ],
            [
                'user' => [
                    'name' => 'David Martinez', 'email' => 'david@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'male', 'dob' => '1990-05-30',
                    'location' => 'Miami, USA',
                ],
                'profile' => [
                    'first_name' => 'David', 'last_name' => 'Martinez',
                    'date_of_birth' => '1990-05-30', 'gender' => 'male',
                    'city' => 'Miami', 'country' => 'USA',
                    'bio' => 'Entrepreneur and fitness enthusiast. I love the ocean, salsa dancing, and building things that matter.',
                    'occupation' => 'Entrepreneur', 'education' => 'bachelors',
                    'relationship_goal' => 'marriage',
                    'interests' => ['fitness', 'dancing', 'swimming', 'business', 'music'],
                    'personality_type' => 'The Achiever',
                    'preferred_gender' => 'female', 'preferred_age_min' => 24, 'preferred_age_max' => 36,
                    'is_complete' => true, 'is_verified' => true,
                    'height' => 182, 'body_type' => 'athletic',
                    'smoking' => 'never', 'drinking' => 'socially',
                    'religion' => 'christian',
                ],
            ],
            [
                'user' => [
                    'name' => 'Priya Sharma', 'email' => 'priya@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'female', 'dob' => '1994-09-12',
                    'location' => 'Toronto, Canada',
                ],
                'profile' => [
                    'first_name' => 'Priya', 'last_name' => 'Sharma',
                    'date_of_birth' => '1994-09-12', 'gender' => 'female',
                    'city' => 'Toronto', 'country' => 'Canada',
                    'bio' => 'Doctor with a passion for classical music and travel. Looking for someone who is kind, driven, and family-oriented.',
                    'occupation' => 'Doctor', 'education' => 'doctorate',
                    'relationship_goal' => 'marriage',
                    'interests' => ['music', 'travel', 'medicine', 'yoga', 'cooking'],
                    'personality_type' => 'The Nurturer',
                    'preferred_gender' => 'male', 'preferred_age_min' => 28, 'preferred_age_max' => 40,
                    'is_complete' => true, 'is_verified' => true,
                    'height' => 162, 'body_type' => 'slim',
                    'smoking' => 'never', 'drinking' => 'never',
                    'religion' => 'hindu',
                ],
            ],
            [
                'user' => [
                    'name' => 'James Anderson', 'email' => 'james@example.com',
                    'role' => 'author', 'status' => 'active',
                    'gender' => 'male', 'dob' => '1988-02-14',
                    'location' => 'Chicago, USA',
                ],
                'profile' => [
                    'first_name' => 'James', 'last_name' => 'Anderson',
                    'date_of_birth' => '1988-02-14', 'gender' => 'male',
                    'city' => 'Chicago', 'country' => 'USA',
                    'bio' => 'Relationship counselor and author. I believe in intentional love and meaningful connections built on trust and communication.',
                    'occupation' => 'Relationship Counselor', 'education' => 'masters',
                    'relationship_goal' => 'long_term',
                    'interests' => ['writing', 'psychology', 'music', 'hiking', 'reading'],
                    'personality_type' => 'The Sage',
                    'preferred_gender' => 'female', 'preferred_age_min' => 28, 'preferred_age_max' => 42,
                    'is_complete' => true, 'is_verified' => true,
                    'height' => 180, 'body_type' => 'average',
                    'smoking' => 'never', 'drinking' => 'occasionally',
                    'religion' => 'christian',
                ],
            ],
            [
                'user' => [
                    'name' => 'Maria Rodriguez', 'email' => 'maria@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'female', 'dob' => '1996-06-20',
                    'location' => 'Barcelona, Spain',
                ],
                'profile' => [
                    'first_name' => 'Maria', 'last_name' => 'Rodriguez',
                    'date_of_birth' => '1996-06-20', 'gender' => 'female',
                    'city' => 'Barcelona', 'country' => 'Spain',
                    'bio' => 'Marketing professional who loves flamenco, good food, and spontaneous road trips. Seeking a real connection with depth.',
                    'occupation' => 'Marketing Manager', 'education' => 'masters',
                    'relationship_goal' => 'long_term',
                    'interests' => ['dancing', 'cooking', 'travel', 'photography', 'fashion'],
                    'personality_type' => 'The Adventurer',
                    'preferred_gender' => 'male', 'preferred_age_min' => 26, 'preferred_age_max' => 40,
                    'is_complete' => true, 'is_verified' => false,
                    'height' => 170, 'body_type' => 'curvy',
                    'smoking' => 'occasionally', 'drinking' => 'socially',
                    'religion' => 'christian',
                ],
            ],
            [
                'user' => [
                    'name' => 'Alex Kim', 'email' => 'alex@example.com',
                    'role' => 'user', 'status' => 'active',
                    'gender' => 'male', 'dob' => '1993-12-05',
                    'location' => 'Seoul, South Korea',
                ],
                'profile' => [
                    'first_name' => 'Alex', 'last_name' => 'Kim',
                    'date_of_birth' => '1993-12-05', 'gender' => 'male',
                    'city' => 'Seoul', 'country' => 'South Korea',
                    'bio' => 'Product designer with a love for K-pop, hiking in the mountains, and exploring new cuisines. Looking for my forever person.',
                    'occupation' => 'Product Designer', 'education' => 'bachelors',
                    'relationship_goal' => 'marriage',
                    'interests' => ['design', 'music', 'hiking', 'food', 'gaming'],
                    'personality_type' => 'Creative Soul',
                    'preferred_gender' => 'female', 'preferred_age_min' => 23, 'preferred_age_max' => 35,
                    'is_complete' => true, 'is_verified' => true,
                    'height' => 175, 'body_type' => 'slim',
                    'smoking' => 'never', 'drinking' => 'socially',
                    'religion' => 'buddhist',
                ],
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['user']['email']],
                array_merge($data['user'], [
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ])
            );

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                $data['profile']
            );
        }

        $this->command->info('✅ 8 sample users created with profiles');
    }
}