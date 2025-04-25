@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        <br><br>
    @endif



    <br>
    <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>

    <!-- Display User Information -->
    <p>Email: {{ $user->email }}</p>
    <!-- Add any other necessary user information -->
    <br>
    <!-- Loan Books Button -->
    <a href="{{ route('loans.create') }}?user_id={{ $user->id }}" class="btn btn-primary" style="margin-bottom:15px;">
        Loan Book(s) to this User
    </a>
    <br><br>
    <h3>Currently Loaned Books</h3>

    <form method="POST" action="{{ route('loans.return') }}">
        @csrf

        <table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse: collapse;">
            <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Book Title</th>
                <th>Loaned At</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($loanedBooks as $loan)
                <tr>
                    <td>
                        <input type="checkbox" name="loan_ids[]" value="{{ $loan->id }}" class="row-checkbox">
                    </td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->loaned_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No books currently loaned.</td></tr>
            @endforelse
            </tbody>
        </table>

        <button type="submit">Return Selected Books</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function(e) {
                    rowCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });
            }
        });
    </script>
@endsection
