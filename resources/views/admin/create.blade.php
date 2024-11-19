@extends('layouts.app')

@section('title', 'Add New Admin')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Admin</h1>
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name"
                class="w-full mt-1 p-2 border rounded-md" value="{{ old('name') }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                class="w-full mt-1 p-2 border rounded-md" value="{{ old('email') }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password"
                class="w-full mt-1 p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full mt-1 p-2 border rounded-md" required>
        </div>
        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-500 to-purple-500 text-white py-3 rounded-md shadow-md hover:shadow-lg">
            Add Admin
        </button>
    </form>
</div>
@endsection
