<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumThread;
use App\Models\User;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) return;

        $threads = [
            [
                'title' => 'Found my person after Week 8 — my story!',
                'category' => 'success',
                'content' => "I joined this platform skeptical, but completing Week 8's lesson on vulnerable communication completely changed how I approached dating. I'll never forget the moment I had an honest conversation with someone I met here. We're now officially together! ❤️",
                'is_pinned' => true,
            ],
            [
                'title' => 'Feeling nervous about my first video date — any tips?',
                'category' => 'advice',
                'content' => "It's my first time doing a virtual date and I'm overthinking everything — what to wear, background, lighting... Has anyone been through this? What actually helped you feel more relaxed?",
            ],
            [
                'title' => 'Week 5 reflection: What I learned about my own patterns',
                'category' => 'growth',
                'content' => "The journaling prompt this week really hit me — \"What do you keep attracting?\" I realized I've been holding on to a fear of vulnerability that has kept me pushing good people away. Writing it out was so healing.",
            ],
            [
                'title' => 'Reminder: Never share your phone number too early!',
                'category' => 'safety',
                'content' => "A friendly reminder to always use the platform's messaging feature before sharing personal contact info. I learned this the hard way — take your time getting to know someone first. Safety first, always! 💪",
            ],
        ];

        foreach ($threads as $t) {
            $t['user_id'] = $users->random()->id;
            ForumThread::create($t);
        }
    }
}
