<?php

use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminAuthController::class, 'login'])->name('login.store');
Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('forgot-password', [AdminAuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AdminAuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [AdminAuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [AdminAuthController::class, 'resetPassword'])->name('password.update');
