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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('school_class');
            $table->string('class_teacher');
            $table->boolean('is_teacher')->default(false);
            $table->boolean('is_student')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_banned')->default(false);
            $table->string('email')->unique();
            $table->foreignId('school_year_id')->constrained('school_years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
