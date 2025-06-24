<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $company = CompanySetting::getSettings();
        
        return view('team.profile', compact('user', 'company'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('team.profile')->with('success', 'Profile updated successfully.');
    }

    public function settings()
    {
        $user = Auth::user();
        $company = CompanySetting::getSettings();
        
        return view('team.settings', compact('user', 'company'));
    }
}
