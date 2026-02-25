<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            // 'category' column add karna, 'id' ke baad
            if (!Schema::hasColumn('quiz_questions', 'category')) {
                $table->string('category')->after('id')->nullable(); 
            }
        });
    }

    public function down(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            if (Schema::hasColumn('quiz_questions', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};