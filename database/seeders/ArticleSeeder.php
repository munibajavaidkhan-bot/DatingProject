<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
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

        if (Article::count() > 0) {
            return;
        }

        $articles = $this->articles();

        foreach ($articles as $article) {
            $slug = Str::slug($article['title']);
            $base = $slug;
            $i    = 1;

            while (Article::where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            Article::create([
                'user_id'       => $author->id,
                'title'         => $article['title'],
                'slug'          => $slug,
                'category'      => $article['category'],
                'category_id'   => \App\Models\Category::where('slug', $article['category'])->value('id'),
                'excerpt'       => $article['excerpt'],
                'body'          => $article['body'],
                'cover_image'   => $article['cover_image'] ?? null,
                'read_minutes'  => $article['read_minutes'],
                'status'        => 'published',
                'is_featured'   => $article['is_featured'] ?? false,
                'published_at'  => now(),
            ]);
        }

        $this->command->info('Seeded ' . count($articles) . ' articles.');
    }

    private function articles(): array
    {
        return [
            [
                'title'        => 'Why Modern Dating Feels Like a Full-Time Job',
                'category'     => 'dating',
                'excerpt'      => 'Understanding why dating today feels exhausting and how to protect your peace.',
                'read_minutes' => 3,
                'cover_image'  => 'card-1.jpg',
                'body'         => "Dating used to feel like a story you were writing with another person. Now it feels like a job application you keep resubmitting.\n\nBetween the apps, the conversations, the second-guessing and the emotional energy you pour into people who barely show up, it is no wonder you feel drained.\n\nHere is the truth: dating was never meant to consume your whole life. If it does, you need space to breathe again. Protect your peace first. The right person will not make you beg for attention or prove your worth.",
            ],
            [
                'title'        => 'The "Talking Stage" Is the Most Confusing Phase Ever',
                'category'     => 'dating',
                'excerpt'      => 'Why the talking stage is full of uncertainty and what to look for before you invest.',
                'read_minutes' => 4,
                'cover_image'  => 'card-2.jpg',
                'body'         => "You text every day. You talk for hours. But you still do not know what you are to each other.\n\nWelcome to the talking stage — a place where consistency and ambiguity somehow exist at the same time. You are not single, but you are not together either.\n\nThe healthiest thing you can do is ask for clarity. A person who wants you will not make you guess. Watch what they do, not just what they say. And never wait so long that you forget what you deserve.",
            ],
            [
                'title'        => "You're Not Asking for Too Much &mdash; You're Asking Too Little",
                'category'     => 'relationships',
                'excerpt'      => "It's not your standards, it's the wrong person.",
                'read_minutes' => 3,
                'cover_image'  => 'card-3.jpg',
                'body'         => "Somewhere along the way you convinced yourself that wanting basic respect was high maintenance.\n\nYou started shrinking your needs so someone would stay. You started celebrating small efforts as grand gestures. But love does not ask you to shrink — it asks you to grow into yourself.\n\nAsk for what you need. Not because you are demanding, but because you know your worth. The right person will not call your needs 'too much'. They will show up to meet them.",
            ],
            [
                'title'        => 'Ghosting Says More About Them Than You',
                'category'     => 'dating',
                'excerpt'      => 'Why ghosting happens and how to move forward with peace.',
                'read_minutes' => 4,
                'cover_image'  => 'card-4.jpg',
                'body'         => "The conversation was going great. Then, suddenly, silence.\n\nGhosting hurts because it leaves you with no answers. But here is what you need to remember: how someone leaves tells you everything about them, and nothing at all about your worth.\n\nYou gave your energy to someone who was not ready to show up honestly. That is not your loss — that is their limitation. Let the silence be your closure. Your real story is still being written.",
            ],
            [
                'title'        => 'Stop Falling for Potential &mdash; Date What\'s in Front of You',
                'category'     => 'relationships',
                'excerpt'      => 'Why potential is not a promise and how it can cost you more.',
                'read_minutes' => 4,
                'cover_image'  => 'card-5.jpg',
                'body'         => "You see who they could be. You imagine who they will become. And every time they fall short, you tell yourself it is just a phase.\n\nBut potential is not a promise. Dating someone for their future and ignoring their present only delays your own growth.\n\nLet me be clear — you should never have to date a blueprint. Choose someone who shows up fully today, not someone who makes you wait for who they might become tomorrow.",
            ],
            [
                'title'        => 'Why Consistency Is More Attractive Than Chemistry',
                'category'     => 'relationships',
                'excerpt'      => 'Consistency builds real relationships. Chemistry doesn\'t.',
                'read_minutes' => 3,
                'cover_image'  => 'card-6.jpg',
                'body'         => "Chemistry is exciting. It makes your heart race and your mind wander. But chemistry without consistency is just a fireworks show — bright, loud, and gone.\n\nConsistency is quieter. It is showing up, keeping promises, and choosing each other even on ordinary days. It does not make your heart race; it makes your heart feel safe.\n\nWhen you learn to value consistency over the thrill, you stop chasing feelings and start building something real.",
            ],
            [
                'title'        => 'The Red Flags We All Ignore (Until It\'s Too Late)',
                'category'     => 'dating',
                'excerpt'      => 'Small signs today, big heartbreaks tomorrow.',
                'read_minutes' => 4,
                'cover_image'  => 'card-7.jpg',
                'body'         => "They cancel plans constantly. They talk badly about their exes. They only have time for you when it is convenient for them.\n\nThese are not small flaws — they are early warnings. And most of us ignore them because we want the story to work out.\n\nPay attention to the first time someone shows you who they are. Believe them. The small signs you ignore today become the big heartbreaks you cry about tomorrow.",
            ],
            [
                'title'        => 'Are You Actually Ready for Love &mdash; or Just Lonely?',
                'category'     => 'self-love',
                'excerpt'      => 'How to know if you\'re ready for love or just escaping loneliness.',
                'read_minutes' => 3,
                'cover_image'  => 'card-8.jpg',
                'body'         => "There is a difference between wanting love and needing to fill a void.\n\nIf you keep choosing people who are not good for you, it might be less about them and more about what you are avoiding in yourself. Loneliness makes us settle. Love, real love, helps us grow.\n\nLearn to be alone before you ask someone to build a life with you. Not because you have to be perfect, but because you deserve a love that chooses you — not a love that just fills your silence.",
            ],
        ];
    }
}