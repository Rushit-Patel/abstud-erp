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
        $query = Role::where('guard_name', 'web')
            ->withCount('permissions', 'users')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest();

        $roles = $query->paginate(15)->withQueryString();

        return view('team.settings.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        $permissions = Permission::where('guard_name', 'web')->get()->groupBy(function ($permission) {
            // Group permissions by category (first part before underscore)
            $parts = explode('_', $permission->name);
            return $parts[0] === 'manage' || $parts[0] === 'view' || $parts[0] === 'create' || $parts[0] === 'edit' || $parts[0] === 'delete' 
                ? $parts[1] ?? $parts[0] 
                : $parts[0];
        });

        return view('team.settings.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id',
            ], [
                'name.required' => 'Role name is required.',
                'name.unique' => 'This role name already exists.',
                'permissions.*.exists' => 'One or more selected permissions are invalid.',
            ]);

            // Create role
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web'
            ]);

            // Assign permissions
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->get();
                $role->syncPermissions($permissions);
            }

            return redirect()->route('team.settings.roles.index')
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
        $permissions = Permission::where('guard_name', 'web')->get()->groupBy(function ($permission) {
            // Group permissions by category (first part before underscore)
            $parts = explode('_', $permission->name);
            return $parts[0] === 'manage' || $parts[0] === 'view' || $parts[0] === 'create' || $parts[0] === 'edit' || $parts[0] === 'delete' 
                ? $parts[1] ?? $parts[0] 
                : $parts[0];
        });

        $role->load('permissions');

        return view('team.settings.roles.edit', compact('role', 'permissions'));
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

            // Update permissions
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->get();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }

            return redirect()->route('team.settings.roles.index')
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
            $systemRoles = ['Super Admin', 'Admin', 'Manager', 'Staff'];
            if (in_array($role->name, $systemRoles)) {
                return redirect()->route('team.settings.roles.index')
                    ->with('error', 'Cannot delete system role: ' . $role->name);
            }

            // Check if role has users
            if ($role->users()->count() > 0) {
                return redirect()->route('team.settings.roles.index')
                    ->with('error', "Cannot delete role '{$role->name}' because it has assigned users. Please reassign users to other roles first.");
            }

            $roleName = $role->name;
            $role->delete();

            return redirect()->route('team.settings.roles.index')
                ->with('success', "Role '{$roleName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->route('team.settings.roles.index')
                ->with('error', 'An error occurred while deleting the role. Please try again.');
        }
    }
}
