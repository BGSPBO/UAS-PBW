<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController; // Import CategoryController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
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
    // Menggunakan resource, kita hanya perlu `except` route yang tidak diperlukan.
    Route::resource('tasks', TaskController::class)->except(['create', 'show', 'edit']);

    // Rute kustom untuk menandai tugas sebagai selesai
    Route::post('/tasks/{task}/complete', [TaskController::class, 'markComplete'])
        ->name('tasks.markComplete');

    // Rute kustom untuk ekspor PDF
    Route::get('/tasks/export-pdf', [TaskController::class, 'exportPdf'])->name('tasks.exportPdf');

    // CRUD untuk kategori
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan route auth default (login, register, dll)
require __DIR__ . '/auth.php';
