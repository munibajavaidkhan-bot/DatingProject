<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Dating Advice',     'slug' => 'dating',          'type' => 'both'],
            ['name' => 'Relationships',     'slug' => 'relationships',   'type' => 'both'],
            ['name' => 'Self Love',         'slug' => 'self-love',       'type' => 'both'],
            ['name' => 'Communication',     'slug' => 'communication',   'type' => 'both'],
            ['name' => 'Boundaries',        'slug' => 'boundaries',      'type' => 'article'],
            ['name' => 'Mindset',           'slug' => 'mindset',         'type' => 'both'],
            ['name' => 'Emotional Intelligence', 'slug' => 'emotional-intelligence', 'type' => 'both'],
            ['name' => 'Conflict Resolution', 'slug' => 'conflict-resolution', 'type' => 'both'],
            ['name' => 'Trust Building',    'slug' => 'trust-building',  'type' => 'both'],
            ['name' => 'Future Planning',   'slug' => 'future-planning', 'type' => 'both'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat + ['is_active' => true]
            );
        }
    }
}
