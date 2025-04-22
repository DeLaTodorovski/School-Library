<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Book::factory()->count(20)->create(); // Create 20 books
        Book::factory()->count(10)->notAvailable()->badState()->readingState()->create(); // Create 20 books
        Book::factory()->count(10)->badState()->readingState()->create(); // Create 20 books
        Book::factory()->count(10)->badState()->create(); // Create 20 books
        Book::factory()->count(10)->readingState()->create(); // Create 20 books
    }
}
