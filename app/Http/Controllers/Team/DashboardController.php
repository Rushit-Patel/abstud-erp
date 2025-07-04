<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use App\Models\Branch;
use App\Models\User;
use App\Models\Student;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $company = CompanySetting::getSettings();
        $stats = [
            'total_users' => User::where('is_active', true)->count(),
            'total_students' => 152,
            'total_partners' => 4545,
            'total_branches' => Branch::where('is_active', true)->count(),
        ];
        return view('team.dashboard', compact('company', 'stats'));
    }
}
