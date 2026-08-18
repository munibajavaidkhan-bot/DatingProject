<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentWeek;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\ForumCategory;
use App\Models\ForumThread;
use App\Models\User;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedContentWeeks();
        $this->seedBlogCategories();
        $this->seedForumCategories();
        $this->seedForumThreads();
        $this->seedBlogPosts();
        $this->command->info('✅ Content, blog categories, forum categories seeded');
    }

    private function seedContentWeeks(): void
    {
        $weeks = [
            [
                'week_number' => 1,
                'title'       => 'Know Yourself First',
                'subtitle'    => 'The Foundation of Every Great Relationship',
                'theme'       => 'self-awareness',
                'category'    => 'self_discovery',
                'description' => 'Before you can truly connect with someone else, you must first understand yourself deeply.',
                'content'     => '<h2>Welcome to Week 1</h2><p>This week we begin with the most important relationship you will ever have — the one with yourself. Research consistently shows that people who have a clear sense of who they are form stronger, more fulfilling partnerships.</p><h3>The Self-Awareness Paradox</h3><p>Most of us think we know ourselves well. But studies suggest that only about 10-15% of people are truly self-aware. This week, we challenge that assumption with gentle curiosity.</p><h3>Your Assignment</h3><p>Take 20 minutes each day this week to journal about these prompts. There are no wrong answers — only honest ones.</p>',
                'exercises'   => [
                    'Write 10 qualities you love about yourself',
                    'Identify 3 patterns from past relationships',
                    'List your top 5 non-negotiable values',
                ],
                'affirmations' => [
                    'I am worthy of deep, meaningful love',
                    'I grow stronger with each day of self-reflection',
                    'Understanding myself helps me connect better with others',
                ],
                'reflection_questions' => [
                    'What do you need from a partner that you haven\'t been able to ask for before?',
                    'What patterns do you notice in your past relationships?',
                    'What does your ideal relationship feel like (not look like)?',
                ],
                'estimated_minutes' => 20,
                'is_premium'        => false,
                'is_published'      => true,
            ],
            [
                'week_number' => 2,
                'title'       => 'Your Attachment Style',
                'subtitle'    => 'Understanding How You Love',
                'theme'       => 'attachment',
                'category'    => 'emotional_intelligence',
                'description' => 'Discover your attachment style and how it shapes your relationships.',
                'content'     => '<h2>The Science of Attachment</h2><p>Developed by psychologist John Bowlby and expanded by Mary Ainsworth, attachment theory explains why we feel and behave the way we do in close relationships. There are four main styles: Secure, Anxious, Avoidant, and Disorganized.</p><h3>Why This Matters</h3><p>Your attachment style was largely shaped in childhood, but here is the good news — it can change. Understanding yours is the first step to forming a secure bond with a future partner.</p>',
                'exercises'   => [
                    'Take the free attachment style quiz at attachmentproject.com',
                    'Write about how your childhood experiences shaped your love style',
                    'List 3 ways your attachment style helps or hurts your relationships',
                ],
                'affirmations' => [
                    'I can move toward secure attachment with awareness and practice',
                    'My past does not define my future relationships',
                    'I communicate my needs with confidence and kindness',
                ],
                'reflection_questions' => [
                    'Which attachment style resonates most with you and why?',
                    'How does your attachment style show up in conflict?',
                    'What would it feel like to be in a securely attached relationship?',
                ],
                'estimated_minutes' => 25,
                'is_premium'        => false,
                'is_published'      => true,
            ],
            [
                'week_number' => 3,
                'title'       => 'The Art of Communication',
                'subtitle'    => 'Say What You Mean, Mean What You Say',
                'theme'       => 'communication',
                'category'    => 'communication',
                'description' => 'Effective communication is not just about talking — it is about being truly understood.',
                'content'     => '<h2>Communication is a Skill</h2><p>The number one complaint in failing relationships is poor communication. Yet most of us were never taught how to communicate effectively in intimate settings. This week, we change that.</p><h3>The 3 Levels of Communication</h3><ol><li><strong>Surface Level:</strong> Facts, information, small talk</li><li><strong>Personal Level:</strong> Opinions, preferences, stories</li><li><strong>Deep Level:</strong> Feelings, fears, vulnerabilities</li></ol><p>Lasting love lives at Level 3. This week, practice moving deeper.</p>',
                'exercises'   => [
                    'Practice "I feel" statements for one week (no "you make me feel")',
                    'Have one 20-minute conversation with no phones or distractions',
                    'Write a letter expressing something you have been afraid to say',
                ],
                'affirmations' => [
                    'I speak my truth with love and clarity',
                    'I listen to understand, not just to respond',
                    'Vulnerable communication builds deep trust',
                ],
                'reflection_questions' => [
                    'What topics do you find hardest to discuss in relationships?',
                    'Do you tend to over-communicate or under-communicate? Why?',
                    'What does being "truly heard" feel like to you?',
                ],
                'estimated_minutes' => 20,
                'is_premium'        => false,
                'is_published'      => true,
            ],
            [
                'week_number' => 4,
                'title'       => 'Love Languages',
                'subtitle'    => 'Give and Receive Love the Right Way',
                'theme'       => 'love-languages',
                'category'    => 'communication',
                'description' => 'Learn the five love languages and discover your primary way of giving and receiving love.',
                'content'     => '<h2>The 5 Love Languages</h2><p>Dr. Gary Chapman\'s groundbreaking work identified five distinct ways people express and receive love. Mismatched love languages are one of the most common causes of feeling unloved — even in loving relationships.</p><h3>The Five Languages</h3><ol><li><strong>Words of Affirmation</strong> — verbal compliments, encouragement, "I love you"</li><li><strong>Acts of Service</strong> — doing things that ease your partner\'s load</li><li><strong>Receiving Gifts</strong> — thoughtful tokens that say "I was thinking of you"</li><li><strong>Quality Time</strong> — focused, undivided attention</li><li><strong>Physical Touch</strong> — hugs, hand-holding, closeness</li></ol>',
                'exercises'   => [
                    'Identify your top 2 love languages',
                    'For 3 days, give love in each of the 5 languages to someone you care about',
                    'Write about a time you felt most loved — what was happening?',
                ],
                'affirmations' => [
                    'I give and receive love in ways that truly resonate',
                    'I communicate my love language needs with ease',
                    'Understanding love languages deepens all my relationships',
                ],
                'reflection_questions' => [
                    'What is your primary love language and how did you discover it?',
                    'Have you ever been in a relationship with someone who had a different love language? How did it feel?',
                    'How will knowing your love language help you in your next relationship?',
                ],
                'estimated_minutes' => 20,
                'is_premium'        => false,
                'is_published'      => true,
            ],
            [
                'week_number' => 5,
                'title'       => 'Setting Healthy Boundaries',
                'subtitle'    => 'Boundaries are Acts of Love',
                'theme'       => 'boundaries',
                'category'    => 'emotional_intelligence',
                'description' => 'Learn why boundaries are not walls — they are the blueprint for a respectful, loving relationship.',
                'content'     => '<h2>Boundaries Are Not Walls</h2><p>Many people confuse boundaries with ultimatums or rejection. In reality, healthy boundaries are the foundation of every thriving relationship. They communicate who you are, what you value, and how you deserve to be treated.</p>',
                'exercises'   => [
                    'List 5 things you will never compromise on in a relationship',
                    'Practice saying "no" once this week without over-explaining',
                    'Write down where your boundaries feel weakest and why',
                ],
                'affirmations' => [
                    'My boundaries honor both myself and those I love',
                    'Setting limits is an act of self-respect',
                    'Healthy boundaries invite healthy relationships',
                ],
                'reflection_questions' => [
                    'Where do you struggle to set boundaries?',
                    'What happens to you emotionally when a boundary is crossed?',
                    'How can you communicate a boundary kindly but firmly?',
                ],
                'estimated_minutes' => 20,
                'is_premium'        => true,
                'is_published'      => true,
            ],
        ];

        // Add weeks 6-52 with placeholder content
        for ($i = 6; $i <= 52; $i++) {
            $categories = [
                'self_discovery', 'communication', 'emotional_intelligence',
                'intimacy', 'conflict_resolution', 'shared_values',
                'future_planning', 'appreciation', 'trust_building', 'growth'
            ];

            $titles = [
                'Emotional Intelligence Mastery',
                'Building Trust Deeply',
                'Navigating Conflict with Grace',
                'Intimacy Beyond the Physical',
                'Shared Dreams & Future Vision',
                'The Art of Appreciation',
                'Forgiveness as a Superpower',
                'Creating Safety Together',
                'Growing as a Couple',
                'Celebrating Your Journey',
            ];

            $weeks[] = [
                'week_number' => $i,
                'title'       => $titles[($i - 6) % count($titles)] . ' — Week ' . $i,
                'subtitle'    => 'Deepening Your Connection Journey',
                'theme'       => 'connection',
                'category'    => $categories[$i % count($categories)],
                'description' => 'This week builds on everything you have learned so far, taking your relationship journey to the next level.',
                'content'     => '<h2>Week ' . $i . ' — Your Journey Continues</h2><p>Each week of this journey is designed to build on the last. By now, you are developing powerful relationship skills that will serve you for life.</p>',
                'exercises'   => [
                    'Complete this week\'s reflection journal',
                    'Practice this week\'s core skill for 10 minutes daily',
                    'Share one insight with someone you trust',
                ],
                'affirmations' => [
                    'I am becoming more relationship-ready every day',
                    'Growth is my constant companion on this journey',
                    'I attract love that matches my highest self',
                ],
                'reflection_questions' => [
                    'What is your biggest takeaway from this week?',
                    'How has this lesson changed your perspective?',
                    'What will you do differently going forward?',
                ],
                'estimated_minutes' => 20,
                'is_premium'        => $i > 4,
                'is_published'      => true,
            ];
        }

        foreach ($weeks as $week) {
            ContentWeek::updateOrCreate(
                ['week_number' => $week['week_number']],
                $week
            );
        }

        $this->command->info('✅ 52 content weeks seeded');
    }

    private function seedBlogCategories(): void
    {
        $categories = [
            ['name' => 'Dating Tips',          'slug' => 'dating-tips',          'color' => '#ec4899'],
            ['name' => 'Relationship Advice',  'slug' => 'relationship-advice',  'color' => '#a855f7'],
            ['name' => 'Self Growth',          'slug' => 'self-growth',          'color' => '#6366f1'],
            ['name' => 'Communication',        'slug' => 'communication',        'color' => '#f59e0b'],
            ['name' => 'Success Stories',      'slug' => 'success-stories',      'color' => '#22c55e'],
            ['name' => 'Expert Insights',      'slug' => 'expert-insights',      'color' => '#f43f5e'],
        ];

        foreach ($categories as $cat) {
            BlogCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }

    private function seedForumCategories(): void
    {
        $categories = [
            ['name' => 'Dating Advice',     'slug' => 'dating-advice',     'icon' => 'fa-heart',          'color' => '#ec4899', 'description' => 'Get advice on dating and finding the right person', 'sort_order' => 1],
            ['name' => 'Relationship Talk', 'slug' => 'relationship-talk', 'icon' => 'fa-users',          'color' => '#a855f7', 'description' => 'Discuss all things relationships', 'sort_order' => 2],
            ['name' => 'Success Stories',   'slug' => 'success-stories',   'icon' => 'fa-star',           'color' => '#f59e0b', 'description' => 'Share your love story and inspire others', 'sort_order' => 3],
            ['name' => 'Self Improvement',  'slug' => 'self-improvement',  'icon' => 'fa-seedling',       'color' => '#22c55e', 'description' => 'Personal growth for better relationships', 'sort_order' => 4],
            ['name' => 'First Date Ideas',  'slug' => 'first-date-ideas',  'icon' => 'fa-map-marker-alt', 'color' => '#f43f5e', 'description' => 'Creative and fun first date inspiration', 'sort_order' => 5],
            ['name' => 'Ask the Community', 'slug' => 'ask-community',     'icon' => 'fa-question-circle','color' => '#6366f1', 'description' => 'Open questions for the community', 'sort_order' => 6],
        ];

        foreach ($categories as $cat) {
            ForumCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }

    private function seedForumThreads(): void
    {
        $users = User::where('role', 'user')->get();
        if ($users->isEmpty()) return;

        $threads = [
            ['title' => 'Found my person after Week 8 — my story!', 'slug' => 'found-my-person-week-8', 'category' => 'success-stories', 'body' => "I joined this platform skeptical, but completing Week 8's lesson on vulnerable communication completely changed how I approached dating. We're now officially together!", 'is_pinned' => true],
            ['title' => 'Feeling nervous about my first video date — any tips?', 'slug' => 'first-video-date-tips', 'category' => 'dating-advice', 'body' => "It's my first time doing a virtual date and I'm overthinking everything. Has anyone been through this? What helped you feel more relaxed?"],
            ['title' => 'Week 5 reflection: What I learned about my own patterns', 'slug' => 'week-5-reflection-patterns', 'category' => 'self-improvement', 'body' => "The journaling prompt this week really hit me. I realized I've been holding on to a fear of vulnerability that has kept me pushing good people away."],
            ['title' => 'Reminder: Never share your phone number too early!', 'slug' => 'safety-phone-number-reminder', 'category' => 'ask-community', 'body' => "A friendly reminder to always use the platform's messaging feature before sharing personal contact info. Safety first, always!"],
        ];

        foreach ($threads as $t) {
            $cat = ForumCategory::where('slug', $t['category'])->first();
            if (!$cat) continue;

            ForumThread::updateOrCreate(
                ['slug' => $t['slug']],
                [
                    'user_id'     => $users->random()->id,
                    'category_id' => $cat->id,
                    'title'       => $t['title'],
                    'body'        => $t['body'],
                    'is_pinned'   => $t['is_pinned'] ?? false,
                    'is_published'=> true,
                ]
            );
        }

        $this->command->info('✅ Forum threads seeded');
    }

    private function seedBlogPosts(): void
    {
        $author = User::where('role', 'author')->first();
        if (!$author) return;

        $category = BlogCategory::where('slug', 'dating-tips')->first();

        $posts = [
            [
                'title'    => '7 Signs You\'re Ready for a Serious Relationship',
                'slug'     => '7-signs-youre-ready-for-serious-relationship',
                'excerpt'  => 'Are you truly ready to commit? These seven signs will help you know for sure.',
                'body'     => '<h2>Are You Ready?</h2><p>Many people enter relationships before they are truly ready, leading to patterns that repeat themselves. Here are seven evidence-based signs that you are emotionally prepared for something real.</p><h3>1. You Know What You Want</h3><p>Vague desires lead to vague relationships. The clearer you are about your values and non-negotiables, the better your chances of finding someone truly compatible.</p><h3>2. You Have Done the Work</h3><p>You have reflected on past relationships, understood your patterns, and taken responsibility for your role in how things ended.</p><h3>3. You Are Happy Alone</h3><p>Happiness should not depend on another person. If you can enjoy your own company, you will bring energy rather than need into a relationship.</p>',
                'status'   => 'published',
                'is_featured' => true,
                'reading_time'=> 5,
                'published_at'=> now()->subDays(3),
            ],
            [
                'title'    => 'The Science Behind Why We Fall in Love',
                'slug'     => 'science-behind-falling-in-love',
                'excerpt'  => 'What actually happens in your brain when you fall in love? The answer will surprise you.',
                'body'     => '<h2>Love is Chemistry — Literally</h2><p>When you fall in love, your brain releases a cocktail of chemicals including dopamine, norepinephrine, and serotonin — the same chemicals triggered by addiction. No wonder love can feel so intense!</p><h3>The Three Stages of Love</h3><p>Researchers from Rutgers University have identified three distinct stages: Lust, Attraction, and Attachment. Each stage involves different hormones and brain regions.</p>',
                'status'   => 'published',
                'is_featured' => false,
                'reading_time'=> 7,
                'published_at'=> now()->subDays(7),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                array_merge($post, [
                    'user_id'     => $author->id,
                    'category_id' => $category?->id,
                ])
            );
        }
    }
}