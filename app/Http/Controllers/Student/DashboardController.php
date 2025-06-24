<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();
        $company = CompanySetting::getSettings();

        return view('student.dashboard', compact('student', 'company'));
    }
}
