<?php

namespace App\Http\Controllers\Team\Lead;

use App\DataTables\Team\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ClientDetails;
use App\Models\ClientLead;
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
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'mobile_no' => 'required',
                'email_id' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'whatsapp_no' => 'required',
                'source' => 'required',
                'lead_type' => 'required',
                // 'address' => 'required',
            ], [
                'mobile_no.required' => 'mobile no is required.',
                'mobile_no.unique' => 'This mobile no already exists.',
                'first_name.required' => 'first name is required.',
                'last_name.required' => 'last name is required.',
                'email_id.required' => 'email is required.',
                'country_id.required' => 'country is required.',
                'state_id.required' => 'state is required.',
                'city_id.required' => 'city is required.',
                'whatsapp_no.required' => 'whatsapp is required.',
                'source.required' => 'source is required.',
                'lead_type.required' => 'lead-type is required.',
                // 'address.required' => 'address is required.',
            ]);

            $validated['country'] = $request->country_id;
            $validated['state'] = $request->state_id;
            $validated['city'] = $request->city_id;
            $validated['address'] = request()->has('address');
            ClientDetails::create($validated);

            return redirect()->route('team.lead.index')
                ->with('success', "Client Details '{$validated['first_name']}' has been created successfully.");

        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()
                ->with('error', 'Error creating Client Details: ' . $e->getMessage());
        }
    }


}
