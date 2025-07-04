<?php

use App\Http\Controllers\SetupController;
use Illuminate\Support\Facades\Route;

// Root redirect based on company setup status
Route::get('/', function () {
    if (!\App\Models\CompanySetting::isSetupCompleted()) {
        return redirect()->route('setup.company');
    }
    return view('welcome');
})->name('home');

// Setup Routes (accessible without company setup)
Route::prefix('setup')->name('setup.')->group(function () {
    // Step 1: Company Information + Branding
    Route::get('company', [SetupController::class, 'showCompanySetup'])->name('company');
    Route::post('company', [SetupController::class, 'storeCompanySetup'])->name('company.store');
    
    // Step 2: Branch Setup 
    Route::get('branch', [SetupController::class, 'showBranchSetup'])->name('branch');
    Route::post('branch', [SetupController::class, 'storeBranchSetup'])->name('branch.store');
    
    // Step 3: Admin User Setup (Final Step)
    Route::get('admin', [SetupController::class, 'showAdminSetup'])->name('admin');
    Route::post('admin', [SetupController::class, 'storeAdminSetup'])->name('admin.store');
    
    // AJAX routes for location dependencies
    Route::get('states/{country}', [SetupController::class, 'getStatesByCountry'])->name('states');
    Route::get('cities/{state}', [SetupController::class, 'getCitiesByState'])->name('cities');
});

// Admin Routes
Route::prefix('team')->name('team.')->middleware('company.setup')->group(function () {
    // Admin Authentication (Public Routes)
    require __DIR__.'/Team/auth.php';

    // Protected Admin Routes
    Route::middleware(['auth:web'])->group(function () {
        // Dashboard Module
        require __DIR__.'/Team/dashboard.php';
        
        // System Settings Module
        require __DIR__.'/Team/systemSettings.php';
        
    });
});

// Student Routes
Route::prefix('student')->name('student.')->middleware('company.setup')->group(function () {
    
});

// Partner Routes
Route::prefix('partner')->name('partner.')->middleware('company.setup')->group(function () {
   
});
