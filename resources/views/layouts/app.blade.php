<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Laravel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-view {
            background-color: #3b82f6; /* blue-500 */
        }
        .btn-view:hover {
            background-color: #1d4ed8; /* blue-700 */
        }
        .btn-edit {
            background-color: #f59e0b; /* amber-500 */
        }
        .btn-edit:hover {
            background-color: #b45309; /* amber-700 */
        }
        .btn-delete {
            background-color: #ef4444; /* red-500 */
        }
        .btn-delete:hover {
            background-color: #b91c1c; /* red-700 */
        }
    </style>
</head>
<body class="antialiased bg-gray-100 font-sans">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="/">
                                <span class="font-semibold text-xl tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('overview') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('overview') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out text-base font-medium leading-5">
                                Overview
                            </a>
                             <a href="{{ route('members.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('members.index') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out text-base font-medium leading-5">
                                Members
                            </a>
                             <a href="{{ route('demographics') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('demographics') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out text-base font-medium leading-5">
                                Demographics
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
