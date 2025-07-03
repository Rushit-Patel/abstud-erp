<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use App\Models\Purpose;
use Illuminate\Http\Request;
use App\DataTables\Team\Setting\PurposeDataTable;

class  PurposeController extends Controller
{
    /**
     * Display a listing of Purpose
     */
    public function index(PurposeDataTable $PurposeDataTable)
    {
        return $PurposeDataTable->render('team.settings.purpose.index');
    }

    /**
     * Show the form for creating a new purpose
     */
    public function create()
    {
        return view('team.settings.purpose.create');
    }

    /**
     * Store a newly created purpose
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'status' => 'boolean',
            ]);

            // Set default values
            $validated['status'] = $request->has('status');
            $validated['timezones'] = $validated['timezones'] ?? [];

            Purpose::create($validated);

            return redirect()->route('team.settings.purpose.index')
                ->with('success', "Purpose '{$validated['name']}' has been created successfully.");

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating purpose: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified purpose
     */
    public function show(Purpose $purpose)
    {
        $purpose->load('states');
        return view('team.settings.purpose.show', compact('purpose'));
    }

    /**
     * Show the form for editing the specified purpose
     */
    public function edit(Purpose $purpose)
    {
        return view('team.settings.purpose.edit', compact('purpose'));
    }

    /**
     * Update the specified purpose
     */
    public function update(Request $request, Purpose $purpose)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:purposes,name,' . $purpose->id,
                'status' => 'boolean',
            ], [
                'name.required' => 'Purpose name is required.',
                'name.unique' => 'This Purpose already exists.',
            ]);

            // Set default values
            $validated['status'] = $request->has('status');

            $purpose->update($validated);

            return redirect()->route('team.settings.purpose.index')
                ->with('success', "Purpose '{$validated['name']}' has been updated successfully.");

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error updating Purpose: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified status
     */
    public function destroy(Purpose $purpose)
    {
        try {
            $purposeName = $purpose->name;
            
            // Check if purpose has states
            if ($purpose->count() > 0) {
                return back()->with('error', "Cannot delete '{$purposeName}' as it has associated states.");
            }

            $purpose->delete();

            return redirect()->route('team.settings.purpose.index')
                ->with('success', "Purpose '{$purposeName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting purpose: ' . $e->getMessage());
        }
    }

    /**
     * Toggle purpose status
     */
    public function toggleStatus(Purpose $purpose)
    {
        try {
            $purpose->update(['status' => !$purpose->status]);
            
            $status = $purpose->status ? 'activated' : 'deactivated';
            
            return back()->with('success', "purpose '{$purpose->name}' has been {$status} successfully.");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating purpose status: ' . $e->getMessage());
        }
    }
}
