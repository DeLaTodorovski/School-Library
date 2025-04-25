@extends('layouts.app')

@section('content')
    <h1>Loaned Books</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pagination Select -->
    <form method="GET" action="{{ route('loans.index') }}" style="margin-bottom: 15px;">
        <label for="per_page">Items per Page:</label>
        <select name="per_page" id="per_page" onchange="this.form.submit()">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
        </select>
    </form>

    <!-- Search Form -->
    <form method="GET" action="{{ route('loans.index') }}">
        <input type="text" name="search" placeholder="Search by book title" value="{{ request('search') }}">
        <input type="hidden" name="per_page" value="{{ $perPage }}">
        <button type="submit">Search</button>
    </form>

    <form method="POST" action="{{ route('loans.return') }}">
        @csrf

        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
            <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Book Title</a></th>
                <th>User</a></th>
                <th>Loaned At</a></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($loans as $loan)
                <tr>
                    <td>
                        <input type="checkbox" name="loan_ids[]" value="{{ $loan->id }}" class="row-checkbox">
                    </td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->user->first_name }} {{ $loan->user->last_name }}</td>
                    <td>{{ $loan->loaned_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No loaned books found.</td></tr>
            @endforelse
            </tbody>
        </table>

        <button type="submit">Return Selected Books</button>
    </form>

    {{ $loans->links() }} <!-- This will render pagination links -->
@endsection

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
