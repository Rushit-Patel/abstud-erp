<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use App\Models\Branch;
use App\Models\User;
use App\Models\Student;
use App\Models\Partner;

class DashboardController extends Controller
{
    public function index()
    {
        $company = CompanySetting::getSettings();
        
        $stats = [
            'total_users' => User::where('is_active', true)->count(),
            'total_students' => Student::where('is_active', true)->count(),
            'total_partners' => Partner::where('is_active', true)->count(),
            'total_branches' => Branch::where('is_active', true)->count(),
        ];
        return view('team.dashboard', compact('company', 'stats'));
    }
}
