// database/migrations/xxxx_create_user_matches_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_one_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_two_id')->constrained('users')->onDelete('cascade');

            // Match scores (percentages)
            $table->integer('compatibility_score')->default(0);    // overall %
            $table->integer('quiz_score')->default(0);             // quiz compatibility %
            $table->integer('interest_score')->default(0);         // shared interests %
            $table->integer('location_score')->default(0);         // proximity %
            $table->integer('preference_score')->default(0);       // preference match %

            // Match status
            $table->enum('status', ['suggested', 'accepted', 'rejected', 'blocked'])->default('suggested');

            // Who acted on the match
            $table->enum('action_by', ['user_one', 'user_two', 'system'])->default('system');

            // Interaction tracking
            $table->boolean('user_one_liked')->default(false);
            $table->boolean('user_two_liked')->default(false);
            $table->timestamp('matched_at')->nullable();  // when both accepted
            $table->timestamp('last_message_at')->nullable();

            $table->unique(['user_one_id', 'user_two_id']); // prevent duplicates
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_matches');
    }
};