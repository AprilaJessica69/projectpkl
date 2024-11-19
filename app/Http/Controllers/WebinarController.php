<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use App\Models\Admin;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    // Menampilkan semua webinar
    public function index()
    {
        $webinars = Webinar::all();
        return view('webinar.index', compact('webinars'));
    }

    // Menampilkan form untuk membuat webinar baru
    public function create()
    {
        $admins = Admin::all(); // Pastikan model Admin sudah terdefinisi dengan benar
        return view('webinar.create', compact('admins'));
    }

    // Menyimpan webinar baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'created_by' => 'required|exists:admins,id',  // Memastikan ID admin yang dipilih valid
        ]);

        // Menyimpan data webinar ke dalam database
        Webinar::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'created_by' => $validated['created_by'],
        ]);

        return redirect()->route('webinar.index');
    }

    // Menampilkan form untuk mengedit webinar
    public function edit($id)
    {
        // Ambil data webinar berdasarkan ID
        $webinar = Webinar::findOrFail($id);

        // Ambil data admins
        $admins = Admin::all(); // Asumsi kamu memiliki model Admin

        // Kirim data ke view
        return view('webinar.edit', compact('webinar', 'admins'));
    }

    // Update webinar
    public function update(Request $request, Webinar $webinar)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|',
        ]);

        // Update data webinar
        $webinar->update($validated);

        return redirect()->route('webinar.index')->with('success', 'Webinar berhasil diubah!');
    }

    // Menghapus webinar
    public function destroy(Webinar $webinar)
    {
        $webinar->delete();
        return redirect()->route('webinar.index')->with('success', 'Webinar berhasil dihapus!');
    }

    public function showParticipants(Webinar $webinar)
{
    // Ambil semua peserta yang terdaftar di webinar
    $participants = $webinar->participants; // Relasi yang sudah didefinisikan sebelumnya

    return view('admin.participant', compact('webinar', 'participants'));
}
}
