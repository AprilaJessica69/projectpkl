@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Jadwal Webinar</h2>

    <form action="{{ route('webinar.update', $webinar->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Webinar</label>
                <input type="text" id="title" name="title" value="{{ old('title', $webinar->title) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>{{ old('description', $webinar->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Field -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Webinar</label>
                <input type="date" id="date" name="date" value="{{ old('date', $webinar->date) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                @error('date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Time Field -->
            <div>
                <label for="time" class="block text-sm font-medium text-gray-700">Waktu Webinar</label>
                <input type="time" id="time" name="time" value="{{ old('time', $webinar->time) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                @error('time')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Admin Field (Admin only) -->
            <div>
                <label for="created_by" class="block text-sm font-medium text-gray-700">Pilih Admin</label>
                <select id="created_by" name="created_by" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Admin</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ old('created_by', $webinar->created_by) == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>
                @error('created_by')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                    Update Webinar
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
