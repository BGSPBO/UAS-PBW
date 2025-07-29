<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Jika sudah login, arahkan ke dashboard, kalau belum ke halaman welcome
Route::middleware('web')->get('/', function () {
    return auth()->check()
        ? redirect('/dashboard')
        : view('welcome');
});

// Dashboard akan menampilkan daftar tugas
Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group semua route yang butuh login
Route::middleware('auth')->group(function () {

    // CRUD untuk tugas
    Route::resource('tasks', TaskController::class);

    // Tambahan route untuk menghapus tugas secara eksplisit
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan route auth default (login, register, dll)
require __DIR__ . '/auth.php';

// Route testing (opsional, bisa dihapus jika tidak dipakai)
Route::get('/test-logout', function () {
    return view('test-logout');
});
