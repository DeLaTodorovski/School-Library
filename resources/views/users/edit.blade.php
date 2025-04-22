@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
        <br>
        <button type="submit">Update User</button>
    </form>
@endsection
