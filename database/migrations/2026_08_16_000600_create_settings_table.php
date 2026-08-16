<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('boolean'); // boolean, text, number, json
            $table->string('group')->default('general');
            $table->string('label');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Seed default feature toggles
        $settings = [
            ['key' => 'chat_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Chat System', 'description' => 'Enable/disable chat between matched users'],
            ['key' => 'forum_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Forum', 'description' => 'Enable/disable the community forum'],
            ['key' => 'quiz_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Personality Quiz', 'description' => 'Enable/disable the personality quiz'],
            ['key' => 'blog_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Blog', 'description' => 'Enable/disable the blog section'],
            ['key' => 'content_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => '52-Week Content', 'description' => 'Enable/disable the 52-week journey content'],
            ['key' => 'matching_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Matching System', 'description' => 'Enable/disable the matching/discover system'],
            ['key' => 'registration_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'system', 'label' => 'Registration', 'description' => 'Enable/disable new user registration'],
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'system', 'label' => 'Maintenance Mode', 'description' => 'Put the site in maintenance mode'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
