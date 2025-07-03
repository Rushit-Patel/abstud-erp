<?php

use App\Http\Controllers\Team\SystemSettings\SystemSettingsController;
use App\Http\Controllers\Team\SystemSettings\CompanySettingsController;
use App\Http\Controllers\Team\SystemSettings\BranchesController;
use App\Http\Controllers\Team\SystemSettings\UsersController;
use App\Http\Controllers\Team\SystemSettings\RolesController;
use App\Http\Controllers\Team\SystemSettings\PermissionsController;
use App\Http\Controllers\Team\SystemSettings\CountriesController;
use App\Http\Controllers\Team\SystemSettings\StatesController;
use App\Http\Controllers\Team\SystemSettings\CitiesController;
use Illuminate\Support\Facades\Route;

// System Settings Routes - Master Administration Panel
Route::prefix('settings')->name('settings.')->group(function () {
    // Main settings dashboard
    Route::get('/', [SystemSettingsController::class, 'index'])->name('index');
    
    // Company Settings
    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/', [CompanySettingsController::class, 'index'])->name('index');
        Route::get('edit', [CompanySettingsController::class, 'edit'])->name('edit');
        Route::put('update', [CompanySettingsController::class, 'update'])->name('update');
        Route::post('logo/upload', [CompanySettingsController::class, 'uploadLogo'])->name('logo.upload');
        Route::delete('logo/remove', [CompanySettingsController::class, 'removeLogo'])->name('logo.remove');
        Route::post('favicon/upload', [CompanySettingsController::class, 'uploadFavicon'])->name('favicon.upload');
        Route::delete('favicon/remove', [CompanySettingsController::class, 'removeFavicon'])->name('favicon.remove');
        
        // AJAX routes for location dependencies
        Route::get('states/{country}', [CompanySettingsController::class, 'getStatesByCountry'])->name('states');
        Route::get('cities/{state}', [CompanySettingsController::class, 'getCitiesByState'])->name('cities');
    });
    
    // Branch Management
    Route::resource('branches', BranchesController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->names('branches');
        
    // Role Management  
    Route::resource('roles', RolesController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('roles');
        
    // Permission Management  
    Route::resource('permissions', PermissionsController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('permissions');
        
    // User Management
    Route::resource('users', UsersController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('users');
    Route::patch('users/{user}/toggle-status', [UsersController::class, 'toggleStatus'])
        ->name('users.toggle-status');
        
    // Country Management
    Route::resource('countries', CountriesController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('countries');
    Route::patch('countries/{country}/toggle-status', [CountriesController::class, 'toggleStatus'])
        ->name('countries.toggle-status');
        
    // State Management
    Route::resource('states', StatesController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('states');
    Route::patch('states/{state}/toggle-status', [StatesController::class, 'toggleStatus'])
        ->name('states.toggle-status');
        
    // City Management
    Route::resource('cities', CitiesController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('cities');
    Route::patch('cities/{city}/toggle-status', [CitiesController::class, 'toggleStatus'])
        ->name('cities.toggle-status');
    // Route::get('cities/states-by-country', [CitiesController::class, 'getStatesByCountry'])
    //     ->name('cities.states-by-country');
    Route::get('cities/states-by-country', [CitiesController::class, 'getStatesByCountry'])
            ->name('cities.states-by-country');

        
});