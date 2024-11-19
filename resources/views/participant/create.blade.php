{{-- participants/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Pendaftaran Peserta Webinar</h1>

        <!-- Tampilkan pesan jika ada notifikasi success -->
        @if (session('success'))
            <div class="text-green-500 text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('participant.store', $webinar->id) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            <!-- Input Nama -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Dropdown Webinar -->
            <div class="mb-4">
                <label for="webinar_id" class="block text-gray-700">Pilih Webinar</label>
                <select id="webinar_id" name="webinar_id" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="">Pilih Webinar</option>
                    @foreach ($webinars as $webinar)
                        <option value="{{ $webinar->id }}">{{ $webinar->title }}</option>
                    @endforeach
                </select>
                @error('webinar_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Daftar -->
            <div class="mt-6 text-center">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Daftar</button>
            </div>
        </form>


    </div>
@endsection
