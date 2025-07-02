<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of permissions
     */
    public function index(Request $request)
    {
        $guard = $request->get('guard', 'web');
        
        $query = Permission::where('guard_name', $guard)
            ->withCount('roles', 'users')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            })
            ->latest();

        $permissions = $query->paginate(20)->withQueryString();

        // Get categories for filter
        $categories = $this->getPermissionCategories();
        
        // Available guards
        $guards = [
            'web' => 'Admin/Staff',
            'student' => 'Students',
            'partner' => 'Partners'
        ];

        return view('team.settings.permissions.index', compact('permissions', 'categories', 'guards', 'guard'));
    }

    /**
     * Show the form for creating a new permission
     */
    public function create(Request $request)
    {
        $guard = $request->get('guard', 'web');
        $categories = $this->getPermissionCategories();
        
        // Available guards
        $guards = [
            'web' => 'Admin/Staff',
            'student' => 'Students',
            'partner' => 'Partners'
        ];
        
        return view('team.settings.permissions.create', compact('categories', 'guards', 'guard'));
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name',
                'guard_name' => 'required|string|in:web,student,partner',
                'display_name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:500',
                'category' => 'required|string|max:100',
            ], [
                'name.required' => 'Permission name is required.',
                'name.unique' => 'This permission name already exists.',
                'guard_name.required' => 'Guard is required.',
                'guard_name.in' => 'Invalid guard selected.',
                'category.required' => 'Permission category is required.',
            ]);

            // Generate permission name based on category and display name
            $permissionName = $this->generatePermissionName($validated['category'], $validated['name']);

            // Create permission
            Permission::create([
                'name' => $permissionName,
                'guard_name' => $validated['guard_name']
            ]);

            return redirect()->route('team.settings.permissions.index', ['guard' => $validated['guard_name']])
                ->with('success', "Permission '{$permissionName}' has been created successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the permission. Please try again.');
        }
    }

    /**
     * Display the specified permission
     */
    public function show(Permission $permission)
    {
        $permission->load('roles.users');
        $permission->loadCount('roles', 'users');

        return view('team.settings.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit(Permission $permission)
    {
        $categories = $this->getPermissionCategories();
        
        // Available guards
        $guards = [
            'web' => 'Admin/Staff',
            'student' => 'Students',
            'partner' => 'Partners'
        ];
        
        return view('team.settings.permissions.edit', compact('permission', 'categories', 'guards'));
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
                'display_name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:500',
            ], [
                'name.required' => 'Permission name is required.',
                'name.unique' => 'This permission name already exists.',
            ]);

            // Update permission
            $permission->update(['name' => $validated['name']]);

            return redirect()->route('team.settings.permissions.index', ['guard' => $permission->guard_name])
                ->with('success', "Permission '{$validated['name']}' has been updated successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the permission. Please try again.');
        }
    }

    /**
     * Remove the specified permission
     */
    public function destroy(Permission $permission)
    {
        try {
            // Check if permission is assigned to any roles
            if ($permission->roles()->count() > 0) {
                return redirect()->route('team.settings.permissions.index', ['guard' => $permission->guard_name])
                    ->with('error', "Cannot delete permission '{$permission->name}' because it is assigned to roles. Please remove it from roles first.");
            }

            $permissionName = $permission->name;
            $guardName = $permission->guard_name;
            $permission->delete();

            return redirect()->route('team.settings.permissions.index', ['guard' => $guardName])
                ->with('success', "Permission '{$permissionName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->route('team.settings.permissions.index')
                ->with('error', 'An error occurred while deleting the permission. Please try again.');
        }
    }

    /**
     * Get permission categories
     */
    private function getPermissionCategories()
    {
        return [
            'users' => 'User Management',
            'roles' => 'Role & Permission Management',
            'company' => 'Company Settings',
            'branches' => 'Branch Management',
            'students' => 'Student Management',
            'partners' => 'Partner Management',
            'reports' => 'Reports & Analytics',
            'communications' => 'Communications',
            'system' => 'System Administration',
            'dashboard' => 'Dashboard Access',
        ];
    }

    /**
     * Generate permission name based on category and action
     */
    private function generatePermissionName($category, $action)
    {
        // Clean the action name
        $action = strtolower(trim($action));
        $action = str_replace([' ', '-'], '_', $action);
        
        // If action doesn't contain the category, add it
        if (!str_contains($action, $category)) {
            $action = $action . '_' . $category;
        }
        
        return $action;
    }
}
