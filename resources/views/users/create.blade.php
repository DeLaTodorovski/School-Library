@extends('layouts.app')

@section('content')
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border flex items-center justify-between gap-8 p-4 mt-2">
        <div class="relative flex flex-col rounded-xl bg-transparent">
            <h4 class="block text-xl font-medium text-slate-800">
                Add User
            </h4>
            <p class="text-slate-500 font-light">
                Create new user account.
            </p>
            <form action="{{ route('users.store') }}" method="POST" class="mt-8 mb-2 w-80 max-w-screen-lg sm:w-96">
                @csrf
                <div class="mb-1 flex flex-col gap-6">
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            First name
                        </label>
                        <input type="text" name="first_name" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="First name" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Last name
                        </label>
                        <input type="text" name="last_name" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="First name" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            School class
                        </label>
                        <select name="school_class" placeholder="School class" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required>
                            @for($i = 1; $i < 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Class Teacher
                        </label>
                        <input type="text" name="class_teacher" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="First name" required/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            User type
                        </label>
                        <select name="is_teacher" placeholder="School class" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required>
                            <option value="0" selected>Student</option>
                            <option value="1">Teacher</option>
                        </select>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            User status
                        </label>
                        <select name="is_banned" placeholder="School class" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required>
                            <option value="0" selected>Active</option>
                            <option value="1">Banned</option>
                        </select>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Email address
                        </label>
                        <input type="email" name="email" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Email address" />
                    </div>
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            School year
                        </label>
                        <select name="school_year_id" placeholder="School class" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required>
                            @foreach ($schoolYear as $year)
                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-4 w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Create user
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
