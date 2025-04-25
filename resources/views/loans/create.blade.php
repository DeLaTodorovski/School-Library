@extends('layouts.app')

@section('content')
    <h1>Create Loan</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <h3>Available Books</h3>

    <form method="POST" action="{{ route('loans.store') }}">
        @csrf

        <!-- User Select Dropdown -->
        <label for="user_id">Select User:</label>
        <select name="user_id" id="user_id" required>
            <option value="">-- Select User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    {{ old('user_id', $selectedUserId ?? '') == $user->id ? 'selected' : '' }}>
                    {{ $user->first_name }} {{ $user->last_name }}
                </option>
            @endforeach
        </select>

        <!-- Search User Input -->
        <input type="text" id="user-search" placeholder="Search for users...">
        <!-- Books Table -->
        <table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse: collapse;">
            <thead>
            <tr>
                <th><input type="checkbox" id="select-all-books"></th>
                <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Book Title</a></th>
                <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'author', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Author</a></th>
                <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'publication_year', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Published At</a></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        <input type="checkbox" name="book_ids[]" value="{{ $book->id }}" class="row-checkbox-book">
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publication_year }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

                {{ $books->links() }} <!-- Pagination Links for Books -->

        <!-- Submit button for loaning selected books to selected users -->
        <button type="submit">Loan Selected Books</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX user search
            $('#user-search').on('input', function() {
                let searchTerm = $(this).val();
                if (searchTerm.length >= 2) {
                    $.ajax({
                        url: '{{ route('loans.searchUsers') }}',
                        type: 'GET',
                        data: { term: searchTerm },
                        success: function(data) {
                            $('#user-select').empty().append('<option value="">Select User</option>');
                            $.each(data, function(index, user) {
                                $('#user-select').append(new Option(user.name, user.id));
                            });
                        }
                    });
                }
            });

            // Remember user selection
            $('#user-select').on('change', function() {
                let selectedUserId = $(this).val();
                if (selectedUserId) {
                    $('#user-search').val($('#user-select option:selected').text());
                }
            });

            // Select/Deselect books
            const selectAllBooks = document.getElementById('select-all-books');
            const bookCheckboxes = document.querySelectorAll('.row-checkbox-book');

            selectAllBooks.addEventListener('change', function(e) {
                bookCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllBooks.checked;
                });
            });
        });
    </script>

@endsection
