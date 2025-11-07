<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| 🌍 Web Routes
|--------------------------------------------------------------------------
| Struktur ini sudah siap untuk skala proyek besar berbasis Laravel + Inertia.
| Dibagi menjadi 3 blok besar:
| 1️⃣ Public routes
| 2️⃣ Authenticated routes
| 3️⃣ Developer/test routes
|--------------------------------------------------------------------------
*/

// ============================================================
// 🏠 1️⃣ PUBLIC ROUTES
// ============================================================
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// ============================================================
// 🔐 2️⃣ AUTHENTICATED ROUTES (Protected by auth & email verification)
// ============================================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard utama
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =======================
    // 📄 AI Content Planner
    // =======================
// Content CRUD
Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
Route::post('/contents', [ContentController::class, 'store'])->name('contents.store');
Route::get('/contents/{content}', [ContentController::class, 'show'])->name('contents.show');


    // =======================
    // 🗓️ AI Schedule Planner
    // =======================
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');

    // =======================
    // 🤖 AI Generator Endpoint (Rate Limited)
    // =======================
    Route::post('/ai/generate', [AIController::class, 'generate'])
        ->middleware('throttle:5,1') // max 5 requests per minute
        ->name('ai.generate');
});

// ============================================================
// 🧪 3️⃣ DEV TEST ROUTES (for debugging / testing APIs)
// ============================================================
Route::get('/test-ai', function () {
    $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => 'Give me 3 content ideas about technology startups'],
        ],
    ]);

    return $response->json();
});

// ============================================================
// 🔚 Authentication Routes
// ============================================================
require __DIR__ . '/auth.php';
