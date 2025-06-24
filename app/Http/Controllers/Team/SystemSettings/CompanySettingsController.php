<?php

namespace App\Http\Controllers\Team\SystemSettings;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanySettingsController extends Controller
{
    /**
     * Display company settings
     */
    public function index()
    {
        $company = CompanySetting::getSettings();
        return view('team.settings.company.index', compact('company'));
    }

    /**
     * Show the form for editing company settings
     */
    public function edit()
    {
        $company = CompanySetting::getSettings();
        return view('team.settings.company.edit', compact('company'));
    }

    /**
     * Update company settings
     */
    public function update(Request $request)
    {
        $company = CompanySetting::first();
        
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_phone' => 'nullable|string|max:20',
            'company_address' => 'nullable|string|max:500',
            'company_website' => 'nullable|url|max:255',
            'company_description' => 'nullable|string|max:1000',
            'timezone' => 'required|string|max:50',
            'date_format' => 'required|string|max:20',
            'time_format' => 'required|string|max:20',
            'currency' => 'required|string|max:10',
            'language' => 'required|string|max:10',
        ]);

        $company->update($request->except(['company_logo', 'company_favicon']));

        return redirect()->route('team.settings.company.index')
            ->with('success', 'Company settings updated successfully.');
    }

    /**
     * Upload company logo
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company = CompanySetting::first();

        // Delete old logo if exists
        if ($company->company_logo) {
            Storage::disk('public')->delete($company->company_logo);
        }

        // Store new logo
        $logoPath = $request->file('logo')->store('company', 'public');
        
        $company->update(['company_logo' => $logoPath]);

        return response()->json([
            'success' => true,
            'message' => 'Logo uploaded successfully.',
            'logo_url' => Storage::url($logoPath)
        ]);
    }

    /**
     * Remove company logo
     */
    public function removeLogo()
    {
        $company = CompanySetting::first();

        if ($company->company_logo) {
            Storage::disk('public')->delete($company->company_logo);
            $company->update(['company_logo' => null]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Logo removed successfully.'
        ]);
    }

    /**
     * Upload company favicon
     */
    public function uploadFavicon(Request $request)
    {
        $request->validate([
            'favicon' => 'required|image|mimes:ico,png|max:1024',
        ]);

        $company = CompanySetting::first();

        // Delete old favicon if exists
        if ($company->company_favicon) {
            Storage::disk('public')->delete($company->company_favicon);
        }

        // Store new favicon
        $faviconPath = $request->file('favicon')->store('company', 'public');
        
        $company->update(['company_favicon' => $faviconPath]);

        return response()->json([
            'success' => true,
            'message' => 'Favicon uploaded successfully.',
            'favicon_url' => Storage::url($faviconPath)
        ]);
    }

    /**
     * Remove company favicon
     */
    public function removeFavicon()
    {
        $company = CompanySetting::first();

        if ($company->company_favicon) {
            Storage::disk('public')->delete($company->company_favicon);
            $company->update(['company_favicon' => null]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Favicon removed successfully.'
        ]);
    }
}