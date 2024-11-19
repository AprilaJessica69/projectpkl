<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Webinar;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Webinar $webinar)
    {
        $participants = $webinar->participants; // Mengambil peserta terkait dengan webinar ini

        return view('participant.index', compact('webinar', 'participants'));
    }

    public function create($webinar_id)
    {
        $webinar = Webinar::findOrFail($webinar_id); // Menemukan webinar berdasarkan ID
        $webinars = Webinar::all(); // Mengambil semua webinar untuk dropdown
        return view('participant.create', compact('webinar', 'webinars'));
    }

    public function store(Request $request, $webinar_id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'webinar_id' => 'required|exists:webinars,id',
        ]);

        // Menyimpan data peserta
        Participant::create([
            'name' => $request->name,
            'email' => $request->email,
            'webinar_id' => $webinar_id,
        ]);

        return redirect()->route('participant.create', $webinar_id)
            ->with('success', 'Pendaftaran peserta berhasil!');
    }

    public function show(Participant $participant)
    {
        return view('participant.show', compact('participant')); // Tampilkan detail peserta
    }

    public function edit(Participant $participant)
    {
        return view('participant.edit', compact('participant')); // Tampilkan form untuk mengedit peserta
    }

    public function update(Request $request, Participant $participant)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->id, // Pastikan email unik
            'webinar_id' => 'required|exists:webinars,id',
        ]);

        $participant->update($validatedData); // Perbarui peserta
        return redirect()->route('participant.index')->with('success', 'Peserta berhasil diperbarui!');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete(); // Hapus peserta
        return redirect()->route('participant.index')->with('success', 'Peserta berhasil dihapus!');
    }
}
