<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the admins.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        // Tambahkan validasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Buat data admin baru
            Admin::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,  // Menyesuaikan dengan id admin yang sedang diedit
            'password' => 'nullable|min:6|confirmed',  // Password bisa dikosongkan jika tidak ingin mengganti
        ]);

        $admin = Admin::findOrFail($id);

        try {
            // Update admin
            $admin->name = $validatedData['name'];
            $admin->email = $validatedData['email'];

            if ($request->filled('password')) {
                $admin->password = Hash::make($validatedData['password']);
            }

            $admin->save();

            return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
{
    // Ambil data admin berdasarkan ID
    $admin = Admin::findOrFail($id);

    // Kirim data admin ke view
    return view('admin.show', compact('admin'));
}

    /**
     * Remove the specified admin from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }
}
