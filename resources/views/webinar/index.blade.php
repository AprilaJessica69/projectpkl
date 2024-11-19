@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Daftar Webinar</h1>

        <!-- Cek jika ada webinar -->
        @if($webinars->isEmpty())
            <div class="text-center text-gray-500">
                <p>Belum ada webinar yang terdaftar.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center px-4"> <!-- Menambahkan padding -->

                @foreach($webinars as $webinar)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-indigo-600">{{ $webinar->title }}</h3>
                        <p class="mt-2 text-gray-600">{{ Str::limit($webinar->description, 100) }}</p>
                        <p class="mt-2 text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($webinar->date)->format('d-m-Y') }}</p>
                        <p class="mt-1 text-gray-500">Waktu: {{ \Carbon\Carbon::parse($webinar->time)->format('H:i') }}</p>
                        <p class="mt-2 text-gray-500">Penggelar: {{ $webinar->admin->name }}</p>

                        <!-- Tombol untuk mendaftar ke webinar ini -->
                        <a href="{{ route('participant.create', $webinar->id) }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Daftar untuk Webinar</a>

                        <!-- Lihat daftar peserta -->
                        <a href="{{ route('participant.index', $webinar->id) }}" class="inline-block mt-4 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-center">
                            Lihat Daftar Peserta
                        </a>

                        <!-- Jika admin yang login, tampilkan tombol edit, hapus, dan tambah -->
                        @if(Auth::check() && str_ends_with(Auth::user()->email, '@admin.com'))
                            <div class="mt-4 flex space-x-4">
                                <!-- Tombol untuk mengedit webinar -->
                                <a href="{{ route('webinar.edit', $webinar->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>

                                <!-- Tombol untuk menghapus webinar -->
                                <form action="{{ route('webinar.destroy', $webinar->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus webinar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Button untuk menambah webinar (admin hanya) -->
        @if(Auth::check() && str_ends_with(Auth::user()->email, '@admin.com'))
            <div class="mt-6 text-center">
                <a href="{{ route('webinar.create') }}" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Webinar</a>
            </div>
        @endif
    </div>
@endsection
