// database/migrations/xxxx_update_quiz_tables.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add missing columns to existing quiz_questions table
        Schema::table('quiz_questions', function (Blueprint $table) {
            if (!Schema::hasColumn('quiz_questions', 'description')) {
                $table->text('description')->nullable()->after('question');
            }
            if (!Schema::hasColumn('quiz_questions', 'options')) {
                $table->text('options')->nullable()->after('type');
            }
            if (!Schema::hasColumn('quiz_questions', 'weight')) {
                $table->integer('weight')->default(1)->after('options');
            }
            if (!Schema::hasColumn('quiz_questions', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('weight');
            }
            if (!Schema::hasColumn('quiz_questions', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            }
        });

        if (!Schema::hasTable('quiz_answers')) {
            Schema::create('quiz_answers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('question_id')->constrained('quiz_questions')->onDelete('cascade');
                $table->json('answer'); // stores selected option(s) or text
                $table->integer('score')->default(0);
                $table->timestamps();
                $table->unique(['user_id', 'question_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_questions');
    }
};