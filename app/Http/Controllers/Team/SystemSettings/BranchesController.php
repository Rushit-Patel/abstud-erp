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
        $branches = Branch::paginate(10);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        Branch::create($request->all());

        return redirect()->route('team.settings.branches.index')
            ->with('success', 'Branch created successfully.');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $branch->update($request->all());

        return redirect()->route('team.settings.branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('team.settings.branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
