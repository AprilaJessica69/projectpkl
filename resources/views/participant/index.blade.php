@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Peserta Webinar: {{ $webinar->title }}</h1>

        <!-- Jika tidak ada peserta -->
        @if($participants->isEmpty())
            <div class="text-center text-gray-500">
                <p>Belum ada peserta yang terdaftar untuk webinar ini.</p>
            </div>
        @else
            <!-- Daftar peserta -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4 text-left text-gray-700">Nama Peserta</th>
                            <th class="py-2 px-4 text-left text-gray-700">Email</th>
                            <th class="py-2 px-4 text-left text-gray-700">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants as $participant)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $participant->name }}</td>
                                <td class="py-2 px-4">{{ $participant->email }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($participant->created_at)->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
