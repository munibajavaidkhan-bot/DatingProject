<?php

namespace Database\Seeders;

use App\Models\Poem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PoemSeeder extends Seeder
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

        if (Poem::count() > 0) {
            return;
        }

        $poems = $this->poems();

        foreach ($poems as $poem) {
            $slug = Str::slug($poem['title']);
            $base = $slug;
            $i    = 1;

            while (Poem::where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            Poem::create([
                'user_id'      => $author->id,
                'title'        => $poem['title'],
                'slug'         => $slug,
                'excerpt'      => $poem['excerpt'],
                'body'         => $poem['body'],
                'cover_image'  => $poem['cover_image'] ?? null,
                'status'       => 'published',
                'is_featured'  => $poem['is_featured'] ?? false,
                'published_at' => now(),
            ]);
        }

        $this->command->info('Seeded ' . count($poems) . ' poems.');
    }

    private function poems(): array
    {
        return [
            [
                'title'   => 'Almost',
                'excerpt' => 'We were almost something, and somehow that felt like everything…',
                'body'    => 'We were almost something,
and somehow that felt like everything.

A heartbeat away from forever,
a breath away from never.

And yet — almost was never enough.
I stopped living in the almost.
I started living in my own.',
            ],
            [
                'title'   => 'Seen',
                'excerpt' => 'You saw my message. I saw your silence. Funny how something so small can say so much…',
                'body'    => 'You saw my message.
I saw your silence.

Funny how something so small
can say so much.

I stopped waiting for a reply.
I gave it to myself instead.',
            ],
            [
                'title'   => 'Timing',
                'excerpt' => "You said it wasn't the right time. But I've learned something about timing…",
                'body'    => "You said it wasn't the right time.
But I've learned something about timing:

if it costs you your peace,
it was never the right time at all.

The right person doesn't need perfect timing.
They make their own.",
            ],
            [
                'title'   => 'The Effort Gap',
                'excerpt' => 'I stopped matching your energy and suddenly there was nothing left…',
                'body'    => 'I stopped matching your energy
and suddenly there was nothing left.

Funny how our whole connection
ran on my effort alone.

I was the thread. I was the glue.
And when I stopped — you never even noticed.',
            ],
            [
                'title'   => 'Closure',
                'excerpt' => 'I waited for an explanation like it was something you owed me.',
                'body'    => 'I waited for an explanation
like it was something you owed me.

But silence… was your answer.

So I closed the door myself.
I gave me the ending you never would.',
            ],
            [
                'title'   => 'Temporary',
                'excerpt' => 'You treated me like something temporary and I treated you like something rare…',
                'body'    => 'You treated me like something temporary
and I treated you like something rare.

One of us gave up an ocean
for a sip of water.

I am done holding that glass.
I deserve the ocean too.',
            ],
            [
                'title'   => 'Standards',
                'excerpt' => "I lowered my standards so you could reach them. And even then, you didn't try…",
                'body'    => "I lowered my standards
so you could reach them.

And even then, you didn't try.

So I'm raising them again —
all the way back up to what I always deserved.",
            ],
            [
                'title'   => 'The Goodbye I Never Got',
                'excerpt' => 'There was no ending. No final conversation. Just distance that slowly became permanent…',
                'body'    => 'There was no ending.
No final conversation.
Just distance that slowly became permanent.

I mourned you without a funeral.
I found peace without a goodbye.',
            ],
            [
                'title'   => 'Peace Over Potential',
                'excerpt' => 'I chose peace over what you could have been…',
                'body'    => "I chose peace
over what you could've been.

I loved the potential of us.
Now I love the possibility of me.

Some doors stay closed
so the windows of the world can open.",
            ],
            [
                'title'       => 'The Love Project',
                'excerpt'     => "This isn't about finding someone. It's about finding yourself again…",
                'is_featured' => true,
                'cover_image' => 'couple.jpg',
                'body'        => "This isn't about finding someone.
It's about unlearning the patterns that made you lose yourself.
It's about choosing clarity over confusion,
peace over potential, and yourself over almost.

Because love — real love —
was never meant to feel this hard.",
            ],
        ];
    }
}