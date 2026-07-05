<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'status')) {
            DB::statement("ALTER TABLE users MODIFY status ENUM('active','suspended','pending','banned') NOT NULL DEFAULT 'active'");
        }

        if (Schema::hasTable('forum_categories') && !Schema::hasColumn('forum_categories', 'threads_count')) {
            Schema::table('forum_categories', function (Blueprint $table) {
                $table->unsignedInteger('threads_count')->default(0)->after('is_active');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('forum_categories') && Schema::hasColumn('forum_categories', 'threads_count')) {
            Schema::table('forum_categories', function (Blueprint $table) {
                $table->dropColumn('threads_count');
            });
        }
    }
};
