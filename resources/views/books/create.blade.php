@extends('layouts.app')

@section('content')
    <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border flex items-center justify-between gap-8 p-4 mt-2">
        <div class="relative flex flex-col rounded-xl bg-transparent">
            <h4 class="block text-xl font-medium text-slate-800">
                Add book
            </h4>
            <p class="text-slate-500 font-light">
                Create new book account.
            </p>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 mb-2 w-80 max-w-screen-lg sm:w-96">
                @csrf
                <div class="mb-1 flex flex-col gap-6">
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Custom ID
                        </label>
                        <input type="number" name="custom_id" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Custom ID" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Title
                        </label>
                        <input type="text" name="title" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Title" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Author
                        </label>
                        <input type="text" name="author" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Author" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Publisher
                        </label>
                        <input type="text" name="publisher" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Publisher" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            School class
                        </label>
                        <select name="publication_year" placeholder="Publication year" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            @for($i = 2000; $i < 2030; $i++)
                                @if($i == date('Y'))
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Description
                        </label>
                        <textarea name="description" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Description here..."></textarea>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Book cover
                        </label>
                        <input type="file" name="cover_image" accept="image/*" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Cover image">
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Available copies
                        </label>
                        <input type="number" name="available_copies" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="0" min="0" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Book state
                        </label>
                        <select name="book_state" placeholder="Book state" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="good" selected>Good</option>
                            <option value="bad">Bad</option>
                        </select>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Book type
                        </label>
                        <select name="book_type" placeholder="Book type" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                            <option value="reading" selected>Reading book</option>
                            <option value="school">School book</option>
                        </select>
                    </div>
                    <button type="submit" class="mt-4 w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Create book
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
