<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\CitizensController;
use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\HouseholdsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Move divisions inside the auth middleware for security
Route::middleware('auth')->group(function () {
    // Only keep this version of the dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    Route::resource('divisions', DivisionsController::class);
    Route::resource('households', HouseholdsController::class);
    Route::resource('citizens', CitizensController::class);
    Route::resource('certificates', CertificatesController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';