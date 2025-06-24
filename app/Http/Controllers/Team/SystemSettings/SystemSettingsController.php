<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use App\Models\CompanySetting;
use App\Models\Student;
use App\Models\Partner;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SystemSettingsController extends Controller
{
    /**
     * Display the main system settings dashboard
     */
    public function index()
    {
        // Get overview statistics for the master settings dashboard
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_branches' => Branch::count(),
            'active_branches' => Branch::where('is_active', true)->count(),
            'total_students' => Student::count(),
            'total_partners' => Partner::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
        ];

        // Get company settings
        $company = CompanySetting::getSettings();

        // Get recent activities (last 10 created users, branches, etc.)
        $recentActivities = [
            'users' => User::latest()->take(5)->get(['id', 'name', 'email', 'created_at']),
            'branches' => Branch::latest()->take(5)->get(['id', 'branch_name', 'branch_code', 'created_at']),
        ];

        // System health checks
        $systemHealth = [
            'setup_completed' => CompanySetting::isSetupCompleted(),
            'main_branch_exists' => Branch::where('is_main_branch', true)->exists(),
            'admin_users_exist' => User::whereHas('roles', function($query) {
                $query->whereIn('name', ['Super Admin', 'Admin']);
            })->exists(),
        ];

        return view('team.settings.index', compact('stats', 'company', 'recentActivities', 'systemHealth'));
    }
}