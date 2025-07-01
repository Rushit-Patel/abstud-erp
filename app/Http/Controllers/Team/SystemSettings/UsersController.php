<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::with(['branch', 'roles'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            })
            ->when($request->branch_id, function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            })
            ->when($request->role, function ($q) use ($request) {
                $q->whereHas('roles', function ($roleQuery) use ($request) {
                    $roleQuery->where('name', $request->role);
                });
            })
            ->when($request->status !== null, function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->latest();

        $users = $query->paginate(15)->withQueryString();
        
        // Get filter options
        $branches = Branch::active()->get();
        $roles = Role::where('guard_name', 'web')->get();

        return view('team.settings.users.index', compact('users', 'branches', 'roles'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $branches = Branch::active()->get();
        $roles = Role::where('guard_name', 'web')->get();
        
        return view('team.settings.users.create', compact('branches', 'roles'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'phone' => 'nullable|string|max:20',
                'password' => ['required', 'confirmed', Password::defaults()],
                'branch_id' => 'required|exists:branches,id',
                'role_id' => 'required|exists:roles,id',
                'is_active' => 'boolean',
            ], [
                'name.required' => 'Full name is required.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email address is already registered.',
                'password.required' => 'Password is required.',
                'password.confirmed' => 'Password confirmation does not match.',
                'branch_id.required' => 'Branch selection is required.',
                'branch_id.exists' => 'Selected branch does not exist.',
                'role_id.required' => 'Role selection is required.',
                'role_id.exists' => 'Selected role does not exist.',
            ]);

            // Set default values
            $validated['is_active'] = $request->has('is_active');
            $validated['password'] = Hash::make($validated['password']);

            // Get role to set user_type automatically
            $role = Role::findById($validated['role_id']);
            $validated['user_type'] = strtolower(str_replace(' ', '_', $role->name));

            // Create user
            $user = User::create($validated);

            // Assign role
            $user->assignRole($role);

            return redirect()->route('team.settings.users.index')
                ->with('success', "User '{$validated['name']}' has been created successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the user. Please try again.');
        }
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load(['branch', 'roles']);
        return view('team.settings.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $branches = Branch::active()->get();
        $roles = Role::where('guard_name', 'web')->get();
        $user->load(['branch', 'roles']);
        
        return view('team.settings.users.edit', compact('user', 'branches', 'roles'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
                'phone' => 'nullable|string|max:20',
                'password' => ['nullable', 'confirmed', Password::defaults()],
                'branch_id' => 'required|exists:branches,id',
                'role_id' => 'required|exists:roles,id',
                'is_active' => 'boolean',
            ], [
                'name.required' => 'Full name is required.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email address is already registered.',
                'password.confirmed' => 'Password confirmation does not match.',
                'branch_id.required' => 'Branch selection is required.',
                'branch_id.exists' => 'Selected branch does not exist.',
                'role_id.required' => 'Role selection is required.',
                'role_id.exists' => 'Selected role does not exist.',
            ]);

            // Set default values
            $validated['is_active'] = $request->has('is_active');

            // Update password only if provided
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            // Get role to set user_type automatically
            $role = Role::findById($validated['role_id']);
            $validated['user_type'] = strtolower(str_replace(' ', '_', $role->name));

            // Update user
            $user->update($validated);

            // Update role
            $user->syncRoles([$role]);

            return redirect()->route('team.settings.users.index')
                ->with('success', "User '{$validated['name']}' has been updated successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        try {
            // Prevent deletion of current user
            if ($user->id === auth()->id()) {
                return redirect()->route('team.settings.users.index')
                    ->with('error', 'You cannot delete your own account.');
            }

            // Prevent deletion of super admin if only one exists
            if ($user->isSuperAdmin()) {
                $superAdminCount = User::whereHas('roles', function ($q) {
                    $q->where('name', 'Super Admin');
                })->count();

                if ($superAdminCount <= 1) {
                    return redirect()->route('team.settings.users.index')
                        ->with('error', 'Cannot delete the last Super Admin user.');
                }
            }

            $userName = $user->name;
            $user->delete();

            return redirect()->route('team.settings.users.index')
                ->with('success', "User '{$userName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->route('team.settings.users.index')
                ->with('error', 'An error occurred while deleting the user. Please try again.');
        }
    }

    /**
     * Toggle user active status
     */
    public function toggleStatus(User $user)
    {
        try {
            // Prevent deactivating current user
            if ($user->id === auth()->id()) {
                return redirect()->back()
                    ->with('error', 'You cannot deactivate your own account.');
            }

            $user->update(['is_active' => !$user->is_active]);
            
            $status = $user->is_active ? 'activated' : 'deactivated';
            
            return redirect()->back()
                ->with('success', "User '{$user->name}' has been {$status} successfully.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating user status.');
        }
    }
}
