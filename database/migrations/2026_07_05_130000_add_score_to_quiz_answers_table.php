<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('quiz_answers') && !Schema::hasColumn('quiz_answers', 'score')) {
            Schema::table('quiz_answers', function (Blueprint $table) {
                $table->integer('score')->default(0)->after('answer');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('quiz_answers') && Schema::hasColumn('quiz_answers', 'score')) {
            Schema::table('quiz_answers', function (Blueprint $table) {
                $table->dropColumn('score');
            });
        }
    }
};
