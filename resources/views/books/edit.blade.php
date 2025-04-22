@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $book->title }}" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="{{ $book->author }}" required>
        <br>
        <button type="submit">Update Book</button>
    </form>
@endsection
