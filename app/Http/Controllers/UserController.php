<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        // Get 'search' and 'per_page' from request
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Allowed items per page options
        $validPerPages = [5, 10, 25, 50];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        // Build query with eager loading of schoolYear relationship
        $query = User::with('schoolYear');

        // Apply search filter if a search term was provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $users = $query->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage
            ]);

        // Return view with users, current search term, and perPage value
        return view('users.index', compact('users', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schoolYear = SchoolYear::all(); // fetch all school years
        return view('users.create', compact('schoolYear'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'school_class' => 'required|string|max:255',
            'class_teacher' => 'required|string|max:255',
            'is_teacher' => 'boolean',
            'is_banned' => 'boolean',
            'email' => 'string|email|unique:users',
            'school_year_id' => 'required|exists:school_years,id',
        ]);

        $user = User::create($request->all());

        return redirect()->route('users.show', $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
