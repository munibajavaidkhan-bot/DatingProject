<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentWeek;

class ContentWeekSeeder extends Seeder
{
    public function run(): void
    {
        $weeks = [
            [
                'week_number' => 1,
                'title' => 'The Foundation of Love',
                'content_body' => 'Welcome to Week 1. This week, we focus on self-awareness and what you truly value in a partner. Reflection is the first step to a lasting connection.',
                'scheduled_date' => now()->startOfWeek(),
            ],
            [
                'week_number' => 2,
                'title' => 'Effective Communication',
                'content_body' => 'Week 2 is all about how we speak and listen. Communication is more than just words; it is about empathy and active listening.',
                'scheduled_date' => now()->startOfWeek()->addWeek(),
            ],
            [
                'week_number' => 3,
                'title' => 'Vulnerability & Trust',
                'content_body' => '“How to open up again” — A gentle guide to vulnerability. In this week, we explore the courage it takes to be seen and known.',
                'scheduled_date' => now()->startOfWeek()->addWeeks(2),
            ],
            [
                'week_number' => 4,
                'title' => 'Conflict Resolution',
                'content_body' => 'Conflicts are inevitable, but they can be healthy. Learn how to navigate disagreements with grace and constructive outcomes.',
                'scheduled_date' => now()->startOfWeek()->addWeeks(3),
            ],
        ];

        foreach ($weeks as $week) {
            ContentWeek::create($week);
        }
    }
}
