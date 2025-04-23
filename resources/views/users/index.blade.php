@extends('layouts.app')

@section('title', 'users')

@section('content')

    <div class="flex items-center justify-between gap-8 p-4 mt-2">

        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
            <div>
                <h5
                    class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Users
                </h5>
                <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    See information about all users
                </p>
            </div>
        </div>
        {{--Buttons--}}
        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
            {{--View All users Button--}}
            <button
                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                <a href="{{ route('users.index') }}">View All</a>
            </button>
            {{--Add New user Button--}}
            <button
                class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                     stroke-width="2" class="w-4 h-4">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                    </path>
                </svg>
                <a href="{{ route('users.create') }}">Add New user</a>
            </button>
        </div>
    </div>

    <div class="flex items-center justify-between gap-8 p-4 ">
        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
            <div>
                {{--users page numbers select--}}
                <div class="flex items-center w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <form method="GET" action="{{ route('users.index') }}">
                            <select name="per_page" id="per_page" onchange="this.form.submit()"
                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                @foreach ([5, 10, 25, 50] as $size)
                                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                    <p class="flex items-center mt-2 text-xs text-slate-500">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-5 h-5 mr-2"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        Items per page.
                    </p>
                </div>
                {{--End users page numbers select--}}
            </div>
        </div>
        <div class="flex flex-col shrink-0 sm:flex-row">
            {{--Search form--}}

            <div class="w-full max-w-sm min-w-[200px]">
                <div class="relative">
                    <form method="GET" id="search" action="{{ route('users.index') }}" class="mb-4">
                    <input type="text" name="search"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Search here..."
                    />
                    <button
                        class="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="submit"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                        </svg>

                        Search
                    </button>
                    </form>
                </div>
            </div>
            {{--End Search form--}}
        </div>
    </div>
    {{--Content--}}

    @php
        // Helper to get the URL for sorting on a column
        function sort_link($column, $label, $sort, $direction) {
            // Toggle direction if currently sorting by this column
            $dir = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';

            // Preserve other query parameters (search, per_page)
            $query = request()->all();
            $query['sort'] = $column;
            $query['direction'] = $dir;

            $url = url()->current() . '?' . http_build_query($query);

            // Add arrow symbol to indicate sort direction
            $arrow = '';
            if ($sort === $column) {
                $arrow = $direction === 'asc' ? ' ▲' : ' ▼';
            }

            return '<a href="'.$url.'">'.e($label).$arrow.'</a>';
        }
    @endphp
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <form id="bulk-delete-form" action="{{ route('users.bulk-delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected users?');">
            @csrf
            @method('DELETE')
        <table class="w-full text-left table-auto p-100">
            <thead>
            <tr>
                <th class="p-4 border-b border-slate-300 bg-slate-50"><input type="checkbox" id="select-all"> Id</th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">{!! sort_link('first_name', 'First Name', $sort, $direction) !!}</th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">{!! sort_link('last_name', 'Last Name', $sort, $direction) !!}</th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">School Class</th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">Class Teacher
                <th class="p-4 border-b border-slate-300 bg-slate-50">Type</th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">Status</th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-slate-50">
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200"><input type="checkbox" name="ids[]" value="{{ $user->id }}" class="row-checkbox"> {{ $user->id }}</td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200">{{ $user->first_name }}</td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200">{{ $user->last_name }}</td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200">{{ $user->school_class }} class</td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200">{{ $user->class_teacher }}</td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200">
                        @if($user->is_teacher)
                            <div class="w-max">
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-blue-900 uppercase rounded-md select-none whitespace-nowrap bg-blue-500/20">
                                    Student
                                </div>
                            </div>
                        @else
                            <div class="w-max">
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-orange-900 uppercase rounded-md select-none whitespace-nowrap bg-orange-500/20">
                                    Teacher
                                </div>
                            </div>
                        @endif
                        {{--                            {{ $user->is_banned ? 'Banned' : 'Active' }}--}}
                    </td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200">
                        @if($user->is_banned)
                            <div class="w-max">
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20">
                                    Banned
                                </div>
                            </div>
                        @else
                            <div class="w-max">
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                    Active
                                </div>
                            </div>
                        @endif
{{--                            {{ $user->is_banned ? 'Banned' : 'Active' }}--}}
                    </td>
                    <td class="p-4 border-b border-blue-gray-50 border-slate-200 font-semibold">
                        <div>
                            <a href="{{ route('users.show', $user->id) }}">View</a>
                        </div>
                        <div>
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        </div>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <button type="submit" class="btn btn-danger" style="margin-top:10px;">
                Delete Selected
            </button>
        </form>
        <div class="m-4">
            {{--            <span><a href="{{ $users->url(1) }}">First</a></span>--}}
            {{ $users->links() }}
            {{--            <span><a href="{{ $users->url($users->lastPage()) }} ">Last</a></span>--}}
        </div>
    </div>
    <script>
        document.getElementById('select-all').addEventListener('change', function(e) {
            let checked = e.target.checked;
            document.querySelectorAll('.row-checkbox').forEach(function(checkbox) {
                checkbox.checked = checked;
            });
        });
    </script>
@endsection
