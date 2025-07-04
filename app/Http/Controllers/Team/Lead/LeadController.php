<?php

namespace App\Http\Controllers\Team\Lead;

use App\DataTables\Team\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\LeadType;
use App\Models\Source;
use App\Models\State;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(LeadDataTable $LeadDataTable)
    {
        return $LeadDataTable->render('team.lead.index');
    }

        /**
     * Show the form for creating a new Source
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $sources = Source::orderBy('name')->get();
        $leadTypes = LeadType::orderBy('name')->get();
        return view('team.lead.create' , compact('countries','sources','leadTypes'));
    }

    /**
     * Store a newly created Source
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required',
                'status' => 'boolean',
            ], [
                'name.required' => 'Source name is required.',
                'name.unique' => 'This Source already exists.',
            ]);

            // Set default values
            $validated['status'] = $request->has('status');

            Source::create($validated);

            return redirect()->route('team.settings.source.index')
                ->with('success', "Source '{$validated['name']}' has been created successfully.");

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating Source: ' . $e->getMessage());
        }
    }


}
