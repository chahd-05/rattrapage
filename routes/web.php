<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', function () {
        return "Admin dashboard";
    });
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('books', BookController::class);
});

Route::middleware('auth')->group(function () {

    Route::post('/reservations', [ReservationController::class, 'store']);

});

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations/{reservation}/approve', [ReservationController::class, 'approve']);
    Route::post('/reservations/{reservation}/reject', [ReservationController::class, 'reject']);

});

require __DIR__.'/auth.php';
