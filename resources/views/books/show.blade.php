@extends('layouts.app')

@section('content')

    <h1>Book Details</h1>
    <p><strong>Custom ID:</strong> {{ $book->custom_id }}</p>
    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
    <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
    <p><strong>Description:</strong> {{ $book->description }}</p>
    @if($book->cover_image)
{{--        <img src="{{ asset('storage/public/' . $book->cover_image) }}" alt="{{ $book->title }}" style="max-width:300px;"> --}}
        <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" style="max-width:300px;">
    @endif

    <a href="{{ route('books.edit', $book->id) }}">Edit Book</a>
    <a href="{{ route('books.index') }}">Back to Books</a>

@endsection
