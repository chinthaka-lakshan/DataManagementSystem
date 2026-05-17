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
Route::middleware(['auth', 'active'])->group(function () {
    // Only keep this version of the dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    Route::resource('divisions', DivisionsController::class);
    
    // GN User only routes
    Route::middleware('role:user')->group(function () {
        Route::resource('households', HouseholdsController::class);
        Route::resource('citizens', CitizensController::class);
        Route::resource('certificates', CertificatesController::class);
        Route::get('/occupations/search', [CitizensController::class, 'searchOccupation'])
    ->name('occupations.search');
    });

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', \App\Http\Controllers\UserController::class);
        
        Route::get('/activity-logs', function() {
            return view('admin.activity_logs');
        })->name('activity-logs');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';