<?php

// YYYY_MM_DD_HHMMSS_add_type_and_options_to_quiz_questions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            // 'type' column ko skip kiya gaya hai kyunki woh pehle se maujood hai.

            // Sirf 'options' column add kar rahe hain
            if (!Schema::hasColumn('quiz_questions', 'options')) {
                $table->json('options')
                      ->after('type') // Assuming 'type' column is already there
                      ->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            // Rollback karne par 'options' column ko delete karna
            if (Schema::hasColumn('quiz_questions', 'options')) {
                $table->dropColumn('options');
            }
        });
    }
};