<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_answers', function (Blueprint $table) {
            // Check if the column exists and modify it to accept string/text
            // Dhyan de: 'change()' use karne ke liye doctrine/dbal package chahiye
            $table->string('answer', 500)->change(); 
        });
    }

    public function down(): void
    {
        // Agar aap rollback karte hain toh wapas integer mein badal sakte hain
        Schema::table('quiz_answers', function (Blueprint $table) {
            $table->integer('answer')->change(); 
        });
    }
};