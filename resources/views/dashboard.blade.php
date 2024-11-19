<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 text-gray-800">
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

    <!-- Page Content -->
    <main class="container mx-auto py-6">
        @if(auth()->check())
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
            <p class="mb-4">You are logged in as: {{ Auth::user()->email }}</p>
        </div>
        @else
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Welcome to Webinar Management</h2>
            <p>Please log in to access your dashboard.</p>
        </div>
        @endif

        <!-- Yield for additional content -->
        @yield('content')
    </main>
</body>

</html>