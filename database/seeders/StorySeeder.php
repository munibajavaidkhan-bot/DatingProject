<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $author = User::whereIn('role', ['author', 'admin'])->first()
            ?? User::first()
            ?? User::create([
                'name'     => 'The Love Project',
                'email'    => 'author@loveproject.com',
                'password' => bcrypt('password'),
                'role'     => 'author',
            ]);

        if (Story::count() > 0) {
            return;
        }

        $stories = $this->stories();

        foreach ($stories as $story) {
            $slug = Str::slug($story['title']);
            $base = $slug;
            $i    = 1;

            while (Story::where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            Story::create([
                'user_id'       => $author->id,
                'title'         => $story['title'],
                'slug'          => $slug,
                'category'      => $story['category'],
                'category_id'   => \App\Models\Category::where('slug', $story['category'])->value('id'),
                'excerpt'       => $story['excerpt'],
                'body'          => $story['body'],
                'cover_image'   => $story['cover_image'] ?? null,
                'read_minutes'  => $story['read_minutes'],
                'status'        => 'published',
                'is_featured'   => $story['is_featured'] ?? false,
                'published_at'  => now(),
            ]);
        }

        $this->command->info('Seeded ' . count($stories) . ' stories.');
    }

    private function stories(): array
    {
        return [
            [
                'title'        => 'Why Modern Dating Feels Like a Full-Time Job',
                'category'     => 'dating',
                'excerpt'      => 'There was a time when meeting someone felt simple. Now every conversation comes with overthinking, expectations and emotional fatigue…',
                'read_minutes' => 10,
                'cover_image'  => 'featured-couple.jpg',
                'is_featured'  => true,
                'body'         => "There was a time when meeting someone felt simple. You bumped into a stranger, exchanged a smile, and let the evening decide where it went.\n\nNow every conversation comes with overthinking, expectations and emotional fatigue. We swipe on hundreds of faces, hold dozens of parallel conversations, and still scroll wondering if the search will ever end.\n\nSomewhere between the notifications, we started treating dating like a job interview instead of a story. We evaluated, compared, and discarded so quickly that we forgot people are not products.\n\nBut here is the thing I learned after months of burnout: the search should not run your life. You can date a little, rest a lot, and still trust that the right story will find you. Protect your peace — it is the most attractive thing you will ever wear.",
            ],
            [
                'title'        => 'The "Talking Stage" Is Where Most Things Go Wrong',
                'category'     => 'dating',
                'excerpt'      => 'How clarity and honesty beat the endless back-and-forth of almost.',
                'read_minutes' => 8,
                'cover_image'  => 'story-1.jpg',
                'body'         => "It starts with a simple message. Then another. Before you know it, you are talking every single day — and you still have no idea what any of it means.\n\nThis is the talking stage, and it is where most things go wrong. Not because talking is bad, but because nobody tells the truth about what they want.\n\nOne person waits. The other person drifts. And a connection that could have been honest turns into a waiting room where you both pretend not to be impatient.\n\nAsk what you are. Not in a dramatic way, but in a brave one. The story that is meant for you will not survive on guesswork — it will survive on honesty.",
            ],
            [
                'title'        => 'Stop Falling for Potential &mdash; It Will Cost You More',
                'category'     => 'self-love',
                'excerpt'      => 'Potential is beautiful until it keeps you waiting forever.',
                'read_minutes' => 9,
                'cover_image'  => 'story-2.jpg',
                'body'         => "She was going to change. He was going to grow. The relationship was going to be everything they both dreamed of — someday.\n\nPotential is beautiful until it keeps you waiting forever. We fall in love with the imaginary version of a person, then spend years grieving that they never show up.\n\nBut potential was never a promise. It is only a picture. And staying with the wrong person because of who they might become does not make you loyal — it makes you late for your own life.\n\nYou cannot build a future with a ghost. Choose someone who is already standing beside you, not someone you keep waiting for.",
            ],
            [
                'title'        => 'Ghosting Hurts More Than We Admit',
                'category'     => 'relationships',
                'excerpt'      => 'The silence after a goodbye is louder than any word.',
                'read_minutes' => 7,
                'cover_image'  => 'story-3.jpg',
                'body'         => "One day you are talking. The next day, nothing.\n\nNo explanation. No goodbye. Just silence that somehow feels louder than any word could be.\n\nGhosting hurts more than we admit because it steals closure. It leaves your mind replaying conversations, looking for the moment it all went wrong.\n\nBut here is the truth: them not showing up has nothing to do with your worth. People who disappear were not built for a real story. They were built for easy exits.\n\nLet them go. Your story does not need a chapter that never respected you enough to end properly.",
            ],
            [
                'title'        => "You're Not Asking for Too Much &mdash; You're Asking the Wrong Person",
                'category'     => 'dating',
                'excerpt'      => 'The same needs become heavy only when you carry them with the wrong person.',
                'read_minutes' => 7,
                'cover_image'  => 'story-4.jpg',
                'body'         => "You have been told it a hundred times: 'You expect too much.' And maybe for a while, you believed it.\n\nBut the same needs that feel heavy with one person feel natural with another. Asking for communication, respect and effort is not high maintenance — it is basic love.\n\nThe problem was never your standards. It was the person standing in front of them.\n\nWith the right person, your needs will not feel like demands. They will feel like a natural part of the story. Do not lower the bar to make someone else feel taller. Raise the floor you refuse to live below.",
            ],
            [
                'title'        => 'Why Consistency Is More Attractive Than Chemistry',
                'category'     => 'dating',
                'excerpt'      => 'Chemistry fades; consistency compounds.',
                'read_minutes' => 8,
                'cover_image'  => 'story-5.jpg',
                'body'         => "Chemistry feels like magic. It sparks on the first date, flickers through the first month, and makes you think you have found everything.\n\nThen the spark fades, and you realize you never had the one thing that actually matters: consistency.\n\nConsistency is the person who remembers. The one who shows up when it is not exciting, who keeps promises when it is inconvenient, and who chooses you on an ordinary Tuesday.\n\nChemistry is the opening scene. Consistency is the whole movie. Learn to fall for the person who stays — not just the one who makes your heart race.",
            ],
            [
                'title'        => 'The Red Flags We All Ignore (Until It\'s Too Late)',
                'category'     => 'relationships',
                'excerpt'      => 'The signs were always there. We just chose the story over the truth.',
                'read_minutes' => 6,
                'cover_image'  => 'story-6.jpg',
                'body'         => "The signs were always there. The cancelled plans. The vague answers. The way they only showed up when they needed something.\n\nWe all ignore red flags because admitting them means admitting the story is not working. So we explain them away, give the relationship another chance, and hope the pattern breaks.\n\nBut patterns do not break by hope. They break by courage.\n\nNext time you see the early signal, listen to it. Your heart already knows. Choose yourself over a story that keeps hurting you — that is the bravest love story you will ever tell.",
            ],
            [
                'title'        => 'Are You Actually Ready for Love &mdash; or Just Lonely?',
                'category'     => 'self-love',
                'excerpt'      => 'Loneliness looks like love when you are desperate enough.',
                'read_minutes' => 6,
                'cover_image'  => 'story-7.jpg',
                'body'         => "Being alone is hard. So hard that sometimes anyone feels better than nobody.\n\nBut loneliness looks a lot like love when you are desperate enough. It blurs the line between 'they are good for me' and 'they are just here'.\n\nI learned this the hard way. Every time I chose someone out of loneliness, I ended up lonelier than before.\n\nSo ask yourself honestly: are you ready for love, or are you just afraid of the quiet? Because the person you attract when you are whole is very different from the person you attract when you are empty.",
            ],
            [
                'title'        => 'Why Good People End Up in Bad Relationships',
                'category'     => 'mindset',
                'excerpt'      => 'Good people give too much, stay too long, and call it love.',
                'read_minutes' => 8,
                'cover_image'  => 'story-8.jpg',
                'body'         => "They are kind. They give freely. They love deeply. And still, they keep ending up in relationships that drain them.\n\nWhy? Because good people often confuse patience with love, and tolerance with commitment.\n\nThey stay too long, give too much, and quietly believe that if they just love harder, the other person will change. But love was never meant to be a rescue mission.\n\nBeing good to others is beautiful. But being good to yourself is survival. Set the boundary, walk away when you must, and save your softness for someone who treats it like the gift it is.",
            ],
        ];
    }
}