<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Plan::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $plans = [
            [
                'name'           => 'Free',
                'slug'           => 'free',
                'description'    => 'Get started and explore the basics of meaningful connection.',
                'price_monthly'  => 0,
                'price_yearly'   => 0,
                'features'       => [
                    '3 matches per day',
                    'Basic messaging (10 messages/day)',
                    'Take the Love Quiz',
                    'Access first 4 weeks of content',
                    'Community forum access',
                ],
                'matches_per_day'       => 3,
                'messages_per_day'      => 10,
                'can_see_who_liked'     => false,
                'can_boost_profile'     => false,
                'has_read_receipts'     => false,
                'has_advanced_filter'   => false,
                'has_video_chat'        => false,
                'is_featured'           => false,
                'badge_color'           => '#6b7280',
                'sort_order'            => 1,
            ],
            [
                'name'           => 'Basic',
                'slug'           => 'basic',
                'description'    => 'More matches, better filters, and priority support.',
                'price_monthly'  => 14.99,
                'price_yearly'   => 119.99,
                'features'       => [
                    '10 matches per day',
                    'Unlimited messaging',
                    'Read receipts',
                    'Access to 26 weeks of content',
                    'Advanced search filters',
                    'See who viewed your profile',
                    'Priority support',
                ],
                'matches_per_day'       => 10,
                'messages_per_day'      => -1,
                'can_see_who_liked'     => false,
                'can_boost_profile'     => false,
                'has_read_receipts'     => true,
                'has_advanced_filter'   => true,
                'has_video_chat'        => false,
                'is_featured'           => false,
                'badge_color'           => '#3b82f6',
                'sort_order'            => 2,
            ],
            [
                'name'           => 'Premium',
                'slug'           => 'premium',
                'description'    => 'The full experience — all features unlocked.',
                'price_monthly'  => 29.99,
                'price_yearly'   => 239.99,
                'features'       => [
                    'Unlimited matches per day',
                    'Unlimited messaging',
                    'See who liked you',
                    'Full 52 weeks of content',
                    'Profile boost (2x per month)',
                    'Video chat with matches',
                    'Advanced compatibility reports',
                    'Dedicated support',
                ],
                'matches_per_day'       => -1,
                'messages_per_day'      => -1,
                'can_see_who_liked'     => true,
                'can_boost_profile'     => true,
                'has_read_receipts'     => true,
                'has_advanced_filter'   => true,
                'has_video_chat'        => true,
                'is_featured'           => true,
                'badge_color'           => '#ec4899',
                'sort_order'            => 3,
            ],
            [
                'name'           => 'VIP',
                'slug'           => 'vip',
                'description'    => 'White-glove matchmaking with a personal coach.',
                'price_monthly'  => 79.99,
                'price_yearly'   => 599.99,
                'features'       => [
                    'Everything in Premium',
                    'Personal matchmaking coach',
                    'Weekly 1-on-1 coaching calls',
                    'Profile professionally written',
                    'Priority match curation',
                    'Exclusive VIP community',
                    'Relationship milestone tracking',
                ],
                'matches_per_day'       => -1,
                'messages_per_day'      => -1,
                'can_see_who_liked'     => true,
                'can_boost_profile'     => true,
                'has_read_receipts'     => true,
                'has_advanced_filter'   => true,
                'has_video_chat'        => true,
                'is_featured'           => false,
                'badge_color'           => '#a855f7',
                'sort_order'            => 4,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }

        $this->command->info('✅ 4 subscription plans seeded');
    }
}