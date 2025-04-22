<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class loanController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loanBook(Request $request){

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'return_due_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if($book->state !== 'available'){
            return response()->json(['error' => 'Book is not available'], 400);
        }

        $loan = Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->id,
            'loaned_at' => now(),
            'return_due_date' => $request->return_due_date
        ]);

        $book->update(['state' => 'not_available']);
        return response()->json($loan, 201);
    }

    public function returnBook(Request $request, Loan $loan){

        $loan->returned_at = now();
        $loan->save();

        $book = Book::findOrFail($request->book_id);
        $book->update(['state' => 'available']);

        return response()->json($loan, 200);
    }

}
