@extends('layouts.app')

@section('content')

    <h1>User Details</h1>
    <p><strong>First Name:</strong> {{ $user->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('users.edit', $user->id) }}">Edit User</a>
    <a href="{{ route('users.index') }}">Back to Users</a>

@endsection
