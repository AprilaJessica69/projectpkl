<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
            <div class="container mx-auto flex justify-between items-center py-4 px-6">
                <a href="{{ route('dashboard') }}" class="text-lg font-extrabold">🎉 Webinar Management</a>
                <ul class="flex gap-6">
                    <!-- Check if the user is logged in and display menu based on email -->
                    @guest
                    <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                    @else
                    <!-- Show Admin menu only for users who are not @gmail.com -->
                    @if(strpos(Auth::user()->email, '@gmail.com') === false)
                    <li><a href="{{ route('admin.index') }}" class="hover:underline">Admin</a></li>
                    @endif

                    <!-- Show Webinars menu for all users -->
                    <li><a href="{{ route('webinar.index') }}" class="hover:underline">Webinars</a></li>

                    <!-- Profile and Logout for logged-in users -->
                    <li><a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:underline">Logout</button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>