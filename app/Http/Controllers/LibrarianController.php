<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Librarian;
use Illuminate\Support\Facades\Hash;

class LibrarianController extends Controller
{
    public function showLoginForm()
    {
        return view('librarians.login'); // Adjusted to use the correct view path
    }

    // Method to handle the login logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Log credentials for debugging (remove in production)
        \Log::debug('Login Attempt: ', $credentials);

        // Attempt to authenticate the librarian
        if (Auth::guard('librarian')->attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('dashboard');
        }

        // Log failure reason
        \Log::warning('Login Failed for Credentials: ', $credentials);

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Optional logout method
    public function logout(Request $request)
    {
        Auth::guard('librarian')->logout();
        return redirect('/librarians/login');
    }
}
