<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SampleUsersSeeder::class,
            QuizQuestionSeeder::class,
            PlansSeeder::class,
            ContentSeeder::class,
            QuizAnswersSeeder::class,
            MatchSeeder::class,
            PoemSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
            StorySeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('🎉 The Love Project database is ready!');
        $this->command->info('Admin: admin@loveproject.com / 12345678');
        $this->command->info('Users: sarah@example.com / password');
    }
}