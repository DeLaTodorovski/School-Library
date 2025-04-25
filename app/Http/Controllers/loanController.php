<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Http\Request;

class loanController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    // List all currently loaned books with users
    public function index(Request $request)
    {

        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default to 10 items per page

        $loansQuery = Loan::with(['user', 'book'])->whereNull('returned_at');

        if ($search) {
            $loansQuery->whereHas('book', function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            });
        }

        $loans = $loansQuery->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage,
        ]);

        return view('loans.index', compact('loans', 'search', 'perPage'));

    }

    // Show form for librarian to loan a book to a user
    public function create(Request $request)
    {

        $bookSearch = $request->input('book_search');

        $users = User::orderBy('last_name')->get();
        $selectedUserId = $request->query('user_id');

        // Fetch books based on search
        $booksQuery = Book::query();
        if ($bookSearch) {
            $booksQuery->where('title', 'like', "%{$bookSearch}%");
        }
        // Remember to paginate the books
        $books = $booksQuery->paginate(10)->appends([
            'book_search' => $bookSearch,
            'selectedUserId' => $selectedUserId
        ]);

//        $books = Book::where('state', 'available')->orderBy('title')->get();

        return view('loans.create', compact('users', 'books', 'selectedUserId'));
    }

    // Store loan record
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // Allow loaning single or multiple books at once:
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

        $userId = $request->input('user_id');
//        $user = User::findOrFail($request->user_id);

        foreach ($request->book_ids as $bookId) {

            $book = Book::findOrFail($bookId);

            if ($book->state !== 'available') {
                return redirect()->back()
                    ->withErrors("Book '{$book->title}' is not available for loan.")
                    ->withInput();
            }

            Loan::create([
                'user_id' => $userId,
                'book_id' => $bookId,
                'loaned_at' => now(),
                // Optionally set returned_at to null here, as these are newly loaned books
            ]);

            // Update book state
            $book->update(['state' => 'not_available']);
        }

        return redirect()->route('users.show', $userId)->with('success', 'Book(s) loaned successfully.');
    }



    public function return(Request $request)
    {
        $request->validate([
            'loan_ids' => 'required|array|min:1',
            'loan_ids.*' => 'exists:loans,id',
        ]);

        // Get the user ID from the first loan record being returned
        $userId = Loan::whereIn('id', $request->loan_ids)->first()->user_id;

        foreach ($request->loan_ids as $loanId) {
            $loan = Loan::findOrFail($loanId);

            // Update the returned_at time
            $loan->update(['returned_at' => now()]);

            // Update the related book state back to available
            $loan->book->update(['state' => 'available']);
        }

        return redirect()->route('users.show', $userId)
            ->with('success', 'Book(s) returned successfully.');
    }

    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('term');

        // Fetch users based on search term
        $users = User::where('first_name', 'like', "%{$searchTerm}%")
            ->orWhere('last_name', 'like', "%{$searchTerm}%")
            ->orWhere('email', 'like', "%{$searchTerm}%")
            ->get(['id', DB::raw("CONCAT(first_name, ' ', last_name) as name")]);

        return response()->json($users);
    }

}
