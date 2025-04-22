<?php

namespace Database\Seeders;

use App\Models\Librarian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Librarian::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'daniel.likovno@gmail.com',
            'password' => Hash::make('123456'), // Be sure to hash the password
        ]);
    }
}
