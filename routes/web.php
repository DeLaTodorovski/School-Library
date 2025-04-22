<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

Route::get('/librarians/login', [LibrarianController::class, 'showLoginForm'])->name('login');
Route::post('/librarians/login', [LibrarianController::class, 'login'])->name('login.submit');
// Route for the logout form
Route::post('/librarians/logout', [LibrarianController::class, 'logout'])->middleware('auth:librarian');


// Make sure these are the only routes that are named 'login'

Route::middleware(['auth:librarian'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Other protected routes go here

    // Other routes that require authentication
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('loans', LoanController::class);
//    // Example route to users
//    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Adjust as needed
//    Route::get('/books', [BookController::class, 'index'])->name('books.index');
});


