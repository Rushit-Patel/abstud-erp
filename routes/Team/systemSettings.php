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
use App\Http\Controllers\Team\SystemSettings\LeadTypesController;
use App\Http\Controllers\Team\SystemSettings\PurposeController;
use App\Http\Controllers\Team\SystemSettings\SourceController;
use App\Http\Controllers\Team\SystemSettings\LeadStatusController;
use App\Http\Controllers\Team\SystemSettings\LeadSubStatusController;
use App\Http\Controllers\Team\SystemSettings\CoachingController;
use App\Http\Controllers\Team\SystemSettings\ForeignCountryController;
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
        Route::post('test-smtp', [CompanySettingsController::class, 'testSmtp'])->name('test-smtp');
        Route::get('preview-smtp-email', [CompanySettingsController::class, 'previewSmtpTestEmail'])->name('preview-smtp-email');
        Route::get('delivery-troubleshooting', [CompanySettingsController::class, 'getDeliveryTroubleshooting'])->name('delivery-troubleshooting');
        Route::get('smtp-status', [CompanySettingsController::class, 'getSmtpStatus'])->name('smtp-status');
        Route::get('email-logs', [CompanySettingsController::class, 'checkEmailLogs'])->name('email-logs');

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

    // Lead Type Management
    Route::resource('lead-types', LeadTypesController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('lead-types');
    Route::patch('lead-types/{leadType}/toggle-status', [LeadTypesController::class, 'toggleStatus'])
        ->name('lead-types.toggle-status');

        // Purpose Management
    Route::resource('purpose', PurposeController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('purpose');

        // Source Management
    Route::resource('source', SourceController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('source');

        // Lead Status Management
    Route::resource('lead-status', LeadStatusController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('lead-status');

        // Lead Sub Status Management
    Route::resource('lead-sub-status', LeadSubStatusController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('lead-sub-status');

        // Coaching Management
    Route::resource('coaching', CoachingController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('coaching');

        // Coaching Management
    Route::resource('foreign-country', ForeignCountryController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->names('foreign-country');

});
