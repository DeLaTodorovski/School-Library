<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Library</title>
{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply bg-white rounded-md px-4 py-2 text-center font-medium text-slate-500 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50 h-10;
        }

        .input {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none rounded-md border-slate-300;
        }

        .filter-container {
            @apply mb-4 flex space-x-2 rounded-md bg-slate-100 p-2;
        }

        .filter-item {
            @apply flex w-full items-center justify-center rounded-md px-4 py-2 text-center text-sm font-medium text-slate-500;
        }

        .filter-item-active {
            @apply bg-white shadow-sm text-slate-800 flex w-full items-center justify-center rounded-md px-4 py-2 text-center text-sm font-medium;
        }

        .book-item {
            @apply text-sm rounded-md bg-white p-4 leading-6 text-slate-900 shadow-md shadow-black/5 ring-1 ring-slate-700/10;
        }

        .book-title {
            @apply text-lg font-semibold text-slate-800 hover:text-slate-600;
        }

        .book-author {
            @apply block text-slate-600;
        }

        .book-rating {
            @apply text-sm font-medium text-slate-700;
        }

        .book-review-count {
            @apply text-xs text-slate-500;
        }

        .empty-book-item {
            @apply text-sm rounded-md bg-white py-10 px-4 text-center leading-6 text-slate-900 shadow-md shadow-black/5 ring-1 ring-slate-700/10;
        }

        .empty-text {
            @apply font-medium text-slate-500;
        }

        .reset-link {
            @apply text-slate-500 underline;
        }
    </style>
    {{-- blade-formatter-enable --}}
</head>

<body>
<nav class="block w-full max-w-screen-lg px-4 py-2 mx-auto bg-slate-50 shadow-md rounded-md lg:px-8 lg:py-3 mt-4">
    <div class="container flex flex-wrap items-center justify-between mx-auto text-slate-800 ">
        <div class="inline-flex items-center">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-slate-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <div class="ml-4">
                <a href="#" class="mr-4 block cursor-pointer py-1.5 text-base text-slate-800 font-semibold">
                    School Library
                </a>
            </div>
        </div>
        <div class="hidden lg:block">
            <ul class="flex flex-col gap-2 mt-2 mb-4 lg:mb-0 lg:mt-0 lg:flex-row lg:items-center lg:gap-6">
                <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                    </svg>

                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        Dashboard
                    </a>
                </li>
                <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
                    </svg>

                    <a href="{{ route('books.index') }}" class="flex items-center">
                        Books
                    </a>
                </li>
                <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <a href="{{ route('users.index') }}" class="flex items-center">
                        Users
                    </a>
                </li>
                <li
                    class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 16l4-4m0 0l-4-4 m4 4h-11m11 5v1a2 2 0 01-2 2H6a3 3 0 01-3-3V7a3 3 0 013-3h10a2 2 0 0 12 2v1" />
                    </svg>

                                <a href="#" class="flex items-center">
                                    <form action="{{ url('/librarians/logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button class="relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] select-none rounded-lg text-center align-middle text-xs font-medium uppercase text-inherit transition-all hover:bg-transparent focus:bg-transparent active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:hidden" type="button">
                  <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                  </span>
                    </button>
                </div>
            </nav>
            <div class="container mx-auto flex flex-col text-gray-700 max-w-screen-lg" >
            <header>



                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">

            {{--            <div class="block w-full overflow-hidden md:w-max">--}}
{{--                <nav>--}}
{{--                    <ul role="tablist" class="relative flex flex-row p-1 rounded-lg bg-blue-gray-50 bg-opacity-60">--}}
{{--                        <li role="tab"--}}
{{--                            class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"--}}
{{--                            data-value="all">--}}
{{--                            <div class="z-20 text-inherit">--}}
{{--                                <a href="{{ route('dashboard') }}">Dashboard</a>--}}
{{--                                <div class="absolute inset-0 z-10 h-full bg-white rounded-md shadow"></div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li role="tab"--}}
{{--                            class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"--}}
{{--                            data-value="unmonitored">--}}
{{--                            <div class="z-20 text-inherit">--}}
{{--                                <a href="{{ route('users.index') }}">Users</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li role="tab"--}}
{{--                            class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"--}}
{{--                            data-value="monitored">--}}
{{--                            <div class="z-20 text-inherit">--}}
{{--                                <a href="{{ route('books.index') }}">Books</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li role="tab"--}}
{{--                        class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"--}}
{{--                        data-value="monitored">--}}
{{--                            <div class="z-20 text-inherit">--}}
{{--                                <form action="{{ url('/librarians/logout') }}" method="POST" style="display:inline;">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit">Logout</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
{{--            </div>--}}

        </div>


</header>
<main>

    @auth
        @yield('content')
    @endauth

    @guest
        @yield('login')
    @endguest

</main>

</body>
</div>
<script>
    function submitSearch() {
        document.getElementById("search").submit();
    }
</script>
</html>
