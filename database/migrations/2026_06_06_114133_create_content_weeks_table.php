// database/migrations/xxxx_create_content_weeks_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_weeks', function (Blueprint $table) {
            $table->id();
            $table->integer('week_number')->unique(); // 1-52
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->longText('content'); // main lesson content (HTML)
            $table->string('theme'); // e.g. "self-discovery", "communication"
            $table->enum('category', [
                'self_discovery',
                'communication',
                'emotional_intelligence',
                'intimacy',
                'conflict_resolution',
                'shared_values',
                'future_planning',
                'appreciation',
                'trust_building',
                'growth'
            ])->default('self_discovery');
            $table->string('video_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('exercises')->nullable(); // weekly exercises
            $table->json('affirmations')->nullable(); // daily affirmations
            $table->json('reflection_questions')->nullable(); // journal prompts
            $table->boolean('is_premium')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('estimated_minutes')->default(15);
            $table->timestamps();
        });

        Schema::create('user_content_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('content_week_id')->constrained('content_weeks')->onDelete('cascade');
            $table->boolean('is_unlocked')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_bookmarked')->default(false);
            $table->integer('progress_percent')->default(0);
            $table->timestamp('unlocked_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('completed_exercises')->nullable();
            $table->text('personal_notes')->nullable();
            $table->integer('reflection_rating')->nullable(); // 1-5
            $table->unique(['user_id', 'content_week_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_content_progress');
        Schema::dropIfExists('content_weeks');
    }
};