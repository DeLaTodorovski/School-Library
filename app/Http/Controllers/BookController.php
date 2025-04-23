<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Search term from query string
        $search = $request->input('search');
        // Items per page, default 10
        $perPage = $request->input('per_page', 10);
        $sort = $request->input('sort', 'id'); // default sort column
        $direction = $request->input('direction', 'asc'); // default direction

        $validSorts = ['id', 'custom_id', 'title', 'author', 'publisher', 'publication_year', 'state', 'book_state', 'book_type', 'created_at']; // columns allowed for sorting
        if (!in_array($sort, $validSorts)) {
            $sort = 'id';
        }

        $validDirections = ['asc', 'desc'];
        if (!in_array($direction, $validDirections)) {
            $direction = 'asc';
        }

        // Validate perPage against allowed values
        $validPerPages = [5, 10, 25, 50];
        if (!in_array($perPage, $validPerPages)) {
            $perPage = 10;
        }

        $query = Book::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%")
                    ->orWhere('custom_id', 'like', "%{$search}%");
            });
        }

        $query->orderBy($sort, $direction);

        // Paginate with per-page and append current search and per_page to links
        $books = $query->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage
            ]);

        return view('books.index', compact('books', 'search', 'perPage', 'sort', 'direction'));



//        $books = Book::all();
//        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(array(
            'custom_id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year'=> 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_copies' => 'nullable|integer',
            'book_state' => 'in:good,bad',
            'book_type' => 'in:reading,school'

        ));

        $data = $request->all();

        // Handle the image upload
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');

            // Create a unique file name
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store in 'public/covers' directory (storage/app/public/covers)
            $image->storeAs('public/covers', $imageName);

            // Save the relative path or filename to DB column
            $data['cover_image'] = 'storage/public/covers/' . $imageName;
        }

        $book = Book::create($data);

        return redirect()->route('books.show', $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No books selected.');
        }

        Book::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Selected book deleted successfully.');
    }
}
