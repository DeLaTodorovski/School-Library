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
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Other protected routes go here

    // Other routes that require authentication
    Route::delete('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');
    Route::delete('/books/bulk-delete', [BookController::class, 'bulkDelete'])->name('books.bulk-delete');
    Route::post('loans/return', [LoanController::class, 'return'])->name('loans.return');
    Route::get('loans/search-users', [LoanedBooksController::class, 'searchUsers'])->name('loans.searchUsers');
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('loans', LoanController::class);

//    // Example route to users
//    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Adjust as needed
//    Route::get('/books', [BookController::class, 'index'])->name('books.index');
});




