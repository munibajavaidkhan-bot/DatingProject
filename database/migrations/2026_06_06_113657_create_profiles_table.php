// database/migrations/xxxx_create_profiles_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
            $table->json('photos')->nullable(); // multiple photos
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->enum('religion', [
                'christian', 'muslim', 'hindu', 'buddhist',
                'jewish', 'sikh', 'atheist', 'agnostic', 'other', 'prefer_not_to_say'
            ])->nullable();
            $table->enum('ethnicity', [
                'asian', 'black', 'hispanic', 'white',
                'middle_eastern', 'mixed', 'other', 'prefer_not_to_say'
            ])->nullable();
            $table->enum('height_unit', ['cm', 'ft'])->default('cm');
            $table->integer('height')->nullable(); // in cm
            $table->enum('body_type', [
                'slim', 'athletic', 'average', 'curvy', 'heavy', 'prefer_not_to_say'
            ])->nullable();
            $table->enum('relationship_goal', [
                'marriage', 'long_term', 'casual', 'friendship', 'not_sure'
            ])->nullable();
            $table->json('interests')->nullable(); // hobbies array
            $table->json('languages')->nullable();
            $table->enum('smoking', ['never', 'occasionally', 'regularly', 'prefer_not_to_say'])->nullable();
            $table->enum('drinking', ['never', 'occasionally', 'socially', 'regularly', 'prefer_not_to_say'])->nullable();
            $table->enum('has_children', ['yes', 'no', 'prefer_not_to_say'])->nullable();
            $table->enum('wants_children', ['yes', 'no', 'maybe', 'prefer_not_to_say'])->nullable();

            // Partner Preferences
            $table->integer('preferred_age_min')->default(18);
            $table->integer('preferred_age_max')->default(99);
            $table->integer('preferred_distance_km')->default(100);
            $table->enum('preferred_gender', ['male', 'female', 'other', 'any'])->default('any');
            $table->json('preferred_religions')->nullable();
            $table->json('preferred_ethnicities')->nullable();

            // Status flags
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('show_online')->default(true);
            $table->timestamp('last_active')->nullable();
            $table->integer('profile_views')->default(0);

            // Personality from quiz
            $table->string('personality_type')->nullable();
            $table->integer('quiz_score')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};