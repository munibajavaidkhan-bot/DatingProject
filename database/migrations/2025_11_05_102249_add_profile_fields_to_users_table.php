<?php

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
        Schema::table('users', function (Blueprint $table) {
          $table->string('gender')->nullable()->after('email');
            $table->date('dob')->nullable()->after('gender');
            $table->string('location')->nullable()->after('dob');
            $table->text('bio')->nullable()->after('location');
            $table->string('profile_picture')->nullable()->after('bio');
            $table->enum('status', ['active','banned'])->default('active')->after('profile_picture');
        });
    }

    /**
     * Reverse the migrations.
     */
public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender','dob','location','bio','profile_picture','status']);
        });
    }
};
