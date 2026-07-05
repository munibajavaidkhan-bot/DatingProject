// database/migrations/xxxx_create_notifications_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // recipient
            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('type', [
                'new_match',
                'match_accepted',
                'match_rejected',
                'new_message',
                'profile_view',
                'quiz_completed',
                'week_unlocked',
                'forum_reply',
                'blog_comment',
                'subscription_expiring',
                'system'
            ]);
            $table->string('title');
            $table->text('message');
            $table->string('icon')->default('fa-bell');
            $table->string('color')->default('#ec4899');
            $table->string('action_url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};