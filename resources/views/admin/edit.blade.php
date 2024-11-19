@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Admin</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menandakan ini adalah request PUT untuk update -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="w-full mt-1 p-2 border rounded-md" value="{{ old('name', $admin->name) }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full mt-1 p-2 border rounded-md" value="{{ old('email', $admin->email) }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="w-full mt-1 p-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full mt-1 p-2 border rounded-md">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Update</button>
    </form>
</div>
@endsection
