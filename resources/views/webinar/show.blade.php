<!-- resources/views/webinars/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">{{ $webinar->title }}</h1>

        <!-- Form untuk menambahkan peserta -->
        <form action="{{ route('webinar.addParticipant', $webinar->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Peserta</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Peserta</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Peserta</button>
        </form>

        <h2 class="text-xl font-semibold text-indigo-600 mt-6">Peserta Terdaftar</h2>
        <ul class="mt-4">
            @foreach($webinar->participants as $participant)
                <li>{{ $participant->name }} ({{ $participant->email }})</li>
            @endforeach
        </ul>
    </div>
@endsection
