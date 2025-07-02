<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of roles
     */
    public function index(Request $request)
    {
        $guard = $request->get('guard', 'web');
        
        $query = Role::where('guard_name', $guard)
            ->withCount('permissions', 'users')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest();

        $roles = $query->paginate(15)->withQueryString();
        
        // Available guards
        $guards = [
            'web' => 'Admin/Staff',
            'student' => 'Students',
            'partner' => 'Partners'
        ];

        return view('team.settings.roles.index', compact('roles', 'guards', 'guard'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create(Request $request)
    {
        $guard = $request->get('guard', 'web');
        
        $permissions = Permission::where('guard_name', $guard)->get()->groupBy(function ($permission) {
            // Group permissions by category based on naming convention
            $name = $permission->name;
            
            // Handle specific patterns
            if (str_contains($name, 'users')) return 'users';
            if (str_contains($name, 'roles') || str_contains($name, 'permissions')) return 'roles';
            if (str_contains($name, 'company')) return 'company';
            if (str_contains($name, 'branches')) return 'branches';
            if (str_contains($name, 'students')) return 'students';
            if (str_contains($name, 'partners')) return 'partners';
            if (str_contains($name, 'reports')) return 'reports';
            if (str_contains($name, 'announcements') || str_contains($name, 'notifications')) return 'communications';
            if (str_contains($name, 'backup') || str_contains($name, 'restore') || str_contains($name, 'system') || str_contains($name, 'audit') || str_contains($name, 'integrations')) return 'system';
            if (str_contains($name, 'dashboard')) return 'dashboard';
            
            // Default grouping by first word
            $parts = explode('_', $name);
            return $parts[1] ?? $parts[0];
        });
        
        // Available guards
        $guards = [
            'web' => 'Admin/Staff',
            'student' => 'Students',
            'partner' => 'Partners'
        ];

        return view('team.settings.roles.create', compact('permissions', 'guards', 'guard'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
                'guard_name' => 'required|string|in:web,student,partner',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id',
            ], [
                'name.required' => 'Role name is required.',
                'name.unique' => 'This role name already exists.',
                'guard_name.required' => 'Guard is required.',
                'guard_name.in' => 'Invalid guard selected.',
                'permissions.*.exists' => 'One or more selected permissions are invalid.',
            ]);

            // Create role
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => $validated['guard_name']
            ]);

            // Assign permissions
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])
                    ->where('guard_name', $validated['guard_name'])
                    ->get();
                $role->syncPermissions($permissions);
            }

            return redirect()->route('team.settings.roles.index', ['guard' => $validated['guard_name']])
                ->with('success', "Role '{$validated['name']}' has been created successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the role. Please try again.');
        }
    }

    /**
     * Display the specified role
     */
    public function show(Role $role)
    {
        $role->load('permissions', 'users');
        $role->loadCount('users');

        return view('team.settings.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('guard_name', $role->guard_name)->get()->groupBy(function ($permission) {
            // Group permissions by category based on naming convention
            $name = $permission->name;
            
            // Handle specific patterns
            if (str_contains($name, 'users')) return 'users';
            if (str_contains($name, 'roles') || str_contains($name, 'permissions')) return 'roles';
            if (str_contains($name, 'company')) return 'company';
            if (str_contains($name, 'branches')) return 'branches';
            if (str_contains($name, 'students')) return 'students';
            if (str_contains($name, 'partners')) return 'partners';
            if (str_contains($name, 'reports')) return 'reports';
            if (str_contains($name, 'announcements') || str_contains($name, 'notifications')) return 'communications';
            if (str_contains($name, 'backup') || str_contains($name, 'restore') || str_contains($name, 'system') || str_contains($name, 'audit') || str_contains($name, 'integrations')) return 'system';
            if (str_contains($name, 'dashboard')) return 'dashboard';
            
            // Default grouping by first word
            $parts = explode('_', $name);
            return $parts[1] ?? $parts[0];
        });

        $role->load('permissions');
        
        // Available guards
        $guards = [
            'web' => 'Admin/Staff',
            'student' => 'Students',
            'partner' => 'Partners'
        ];

        return view('team.settings.roles.edit', compact('role', 'permissions', 'guards'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, Role $role)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id',
            ], [
                'name.required' => 'Role name is required.',
                'name.unique' => 'This role name already exists.',
                'permissions.*.exists' => 'One or more selected permissions are invalid.',
            ]);

            // Update role
            $role->update(['name' => $validated['name']]);

            // Update permissions (ensure they match the role's guard)
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])
                    ->where('guard_name', $role->guard_name)
                    ->get();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }

            return redirect()->route('team.settings.roles.index', ['guard' => $role->guard_name])
                ->with('success', "Role '{$validated['name']}' has been updated successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the role. Please try again.');
        }
    }

    /**
     * Remove the specified role
     */
    public function destroy(Role $role)
    {
        try {
            // Prevent deletion of core system roles
            $systemRoles = ['Super Admin', 'Admin', 'Manager', 'Staff', 'Active Student', 'Graduated Student', 'Corporate Partner', 'Educational Partner'];
            if (in_array($role->name, $systemRoles)) {
                return redirect()->route('team.settings.roles.index', ['guard' => $role->guard_name])
                    ->with('error', 'Cannot delete system role: ' . $role->name);
            }

            // Check if role has users
            if ($role->users()->count() > 0) {
                return redirect()->route('team.settings.roles.index', ['guard' => $role->guard_name])
                    ->with('error', "Cannot delete role '{$role->name}' because it has assigned users. Please reassign users to other roles first.");
            }

            $roleName = $role->name;
            $guard = $role->guard_name;
            $role->delete();

            return redirect()->route('team.settings.roles.index', ['guard' => $guard])
                ->with('success', "Role '{$roleName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->route('team.settings.roles.index')
                ->with('error', 'An error occurred while deleting the role. Please try again.');
        }
    }
}
