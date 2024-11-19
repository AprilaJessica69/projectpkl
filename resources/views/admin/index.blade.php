@extends('layouts.app')

@section('title', 'Admin List')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">
        Admin List
    </h1>
    <a href="{{ route('admin.create') }}"
        class="inline-block mt-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-md shadow-md hover:shadow-lg">
        + Add New Admin
    </a>
    <div class="mt-6">
        @if($admins->isEmpty())
            <p class="text-gray-500 italic">No admins found.</p>
        @else
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-200 to-purple-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $admin->name }}</td>
                            <td class="px-4 py-3">{{ $admin->email }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.edit', $admin->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this admin?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
