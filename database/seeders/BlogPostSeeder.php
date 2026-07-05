<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', 'author')->first() ?? User::first();
        if (!$author) return;

        $posts = [
            [
                'title' => 'The Science of First Impressions',
                'category' => 'science',
                'content' => '<p>First impressions are formed within seconds. In the world of dating, this can mean the difference between a second date and a polite goodbye. Here is how you can master the art of the first meeting...</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Navigating Digital Dating Fatigue',
                'category' => 'wellness',
                'content' => '<p>Do you feel overwhelmed by the endless swiping? You are not alone. Digital dating fatigue is real, but it can be managed by following these three core principles...</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Healthy Boundaries in New Relationships',
                'category' => 'advice',
                'content' => '<p>Setting boundaries early on is the foundation of a healthy partnership. Many people fear that setting boundaries will push others away, but the opposite is true...</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'How to Spot Emotional Availability',
                'category' => 'advice',
                'content' => '<p>Emotional availability is the "secret sauce" of long-term success. But how do you spot it in someone you have just met? Look for these five key indicators...</p>',
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            $post['author_id'] = $author->id;
            BlogPost::create($post);
        }
    }
}
