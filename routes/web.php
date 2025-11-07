<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AIController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ScheduleController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('home');

    Route::resource('content', ContentController::class);
    Route::post('ai/generate', [AIController::class, 'generate'])->name('ai.generate');
    Route::post('schedules', [ScheduleController::class, 'store'])->name('schedules.store');
});
Route::post('ai/generate', [AIController::class,'generate'])->middleware('throttle:5,1'); // 5 requests per minute
Route::resource('contents', ContentController::class)->only(['index', 'store']);


require __DIR__.'/auth.php';
