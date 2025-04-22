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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->string('publication_year');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('available_copies')->default(1);
            $table->enum('state', ['available', 'not_available'])->default('available');
            $table->enum('book_state', ['good', 'bad'])->default('good');
            $table->enum('book_type', ['reading', 'school'])->default('reading');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
