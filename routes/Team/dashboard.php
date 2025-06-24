<?php

use App\Http\Controllers\Team\DashboardController;
use App\Http\Controllers\Team\ProfileController;
use Illuminate\Support\Facades\Route;

// Team Dashboard Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Profile Routes
Route::get('profile', [ProfileController::class, 'show'])->name('profile');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

// Settings Routes
Route::get('settings', [ProfileController::class, 'settings'])->name('settings');

// Component Test Route (for development/testing)
Route::get('component-test', function () {
    return view('team.component-test');
})->name('component-test');