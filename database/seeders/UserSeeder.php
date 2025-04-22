<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolYear::factory()->count(1)->create();

        User::factory()->count(100)->create(); // Create 100 users
    }
}
