<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Route (admin resource CRUD)
Route::resource('admin', AdminController::class);

// Webinar Route (webinar resource CRUD)
Route::resource('webinar', WebinarController::class);


// Route untuk melihat daftar peserta dari sebuah webinar (admin)
Route::get('/webinars/{webinar}/participants', [ParticipantController::class, 'index'])->name('participant.index');

// Route untuk menampilkan form pendaftaran peserta
// Routes/web.php

// Rute untuk menampilkan form pendaftaran
Route::get('/webinars/{webinar}/register', [ParticipantController::class, 'create'])
    ->name('participant.create');  // Menyesuaikan nama rute dengan 'participant.create'

// Rute untuk menyimpan data peserta
Route::post('/webinars/{webinar}/register', [ParticipantController::class, 'store'])
    ->name('participant.store');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
