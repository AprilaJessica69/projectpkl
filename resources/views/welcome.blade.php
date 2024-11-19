<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 text-gray-100 font-sans">

    <!-- Welcome Section -->
    <div class="flex justify-center items-center min-h-screen px-4 py-6">
        <div class="text-center space-y-6">
            <h1 class="text-5xl font-extrabold text-white mb-6 leading-tight">Selamat datang di Webinar Management</h1>
            <p class="text-lg text-gray-200 mb-6">Temukan jadwal webinar terbaik dan daftar untuk acara menarik yang akan datang.</p>

            @if (Route::has('login'))
            <div class="space-x-6">
                @auth
                <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-3 text-white bg-gradient-to-r from-green-400 via-teal-500 to-blue-500 rounded-xl shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="inline-block px-8 py-3 text-white bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-xl shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">Login</a>
                <a href="{{ route('register') }}" class="inline-block px-8 py-3 text-white bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 rounded-xl shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">Daftar</a>
                @endauth
            </div>
            @endif
        </div>
    </div>

</body>

</html>