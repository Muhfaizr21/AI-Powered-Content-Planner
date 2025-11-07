<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ScheduleController;

// =======================
// 🏠 Public Routes
// =======================
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// =======================
// 🔐 Authenticated Routes
// =======================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =======================
    // 📄 Content Routes (CRUD)
    // =======================
Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
Route::post('/contents', [ContentController::class, 'store'])->name('contents.store');
Route::get('/contents/{id}', [ContentController::class, 'show'])->name('contents.show');

    // =======================
    // 🤖 AI Generator
    // =======================
    Route::post('/ai/generate', [AIController::class, 'generate'])
        ->middleware('throttle:5,1')
        ->name('ai.generate');

    // =======================
    // ⏰ Schedule
    // =======================
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
});

require __DIR__ . '/auth.php';
