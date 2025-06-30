<?php

use App\Http\Controllers\Team\DashboardController;
use App\Http\Controllers\Team\Lead\LeadController;
use App\Http\Controllers\Team\ProfileController;
use Illuminate\Support\Facades\Route;



// Only Ui routes are defined here, no for live data.
Route::get('lead', [LeadController::class,'index'])->name('leads.index');


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