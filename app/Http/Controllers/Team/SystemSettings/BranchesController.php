<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of branches
     */
    public function index()
    {
        $branches = Branch::latest()->paginate(10);
        return view('team.settings.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new branch
     */
    public function create()
    {
        return view('team.settings.branches.create');
    }

    /**
     * Store a newly created branch
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'branch_name' => 'required|string|max:255',
                'branch_code' => 'required|string|max:10|unique:branches,branch_code',
                'address' => 'nullable|string|max:1000',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'manager_name' => 'nullable|string|max:255',
                'is_active' => 'boolean',
            ], [
                'branch_name.required' => 'Branch name is required.',
                'branch_code.required' => 'Branch code is required.',
                'branch_code.unique' => 'This branch code is already taken.',
                'email.email' => 'Please enter a valid email address.',
            ]);

            // Set default values
            $validated['is_active'] = $request->has('is_active');
            $validated['is_main_branch'] = false;

            Branch::create($validated);

            return redirect()->route('team.settings.branches.index')
                ->with('success', "Branch '{$validated['branch_name']}' has been created successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the branch. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified branch
     */
    public function edit(Branch $branch)
    {
        return view('team.settings.branches.edit', compact('branch'));
    }

    /**
     * Update the specified branch
     */
    public function update(Request $request, Branch $branch)
    {
        try {
            $validated = $request->validate([
                'branch_name' => 'required|string|max:255',
                'branch_code' => 'required|string|max:10|unique:branches,branch_code,' . $branch->id,
                'address' => 'nullable|string|max:1000',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'manager_name' => 'nullable|string|max:255',
                'is_active' => 'boolean',
            ], [
                'branch_name.required' => 'Branch name is required.',
                'branch_code.required' => 'Branch code is required.',
                'branch_code.unique' => 'This branch code is already taken.',
                'email.email' => 'Please enter a valid email address.',
            ]);

            // Set default values
            $validated['is_active'] = $request->has('is_active');

            $branch->update($validated);

            return redirect()->route('team.settings.branches.index')
                ->with('success', "Branch '{$validated['branch_name']}' has been updated successfully.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the branch. Please try again.');
        }
    }

    /**
     * Remove the specified branch
     */
    public function destroy(Branch $branch)
    {
        try {
            // Check if this is the main branch
            if ($branch->is_main_branch) {
                return redirect()->route('team.settings.branches.index')
                    ->with('error', 'Cannot delete the main branch.');
            }

            // Check if branch has users
            if ($branch->users()->count() > 0) {
                return redirect()->route('team.settings.branches.index')
                    ->with('error', 'Cannot delete branch that has users assigned to it.');
            }

            $branchName = $branch->branch_name;
            $branch->delete();

            return redirect()->route('team.settings.branches.index')
                ->with('success', "Branch '{$branchName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->route('team.settings.branches.index')
                ->with('error', 'An error occurred while deleting the branch. Please try again.');
        }
    }
}
