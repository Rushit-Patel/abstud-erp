/**
 * Example: How to use LocationAjax in other modules
 * 
 * This example shows how to implement location dropdowns in any module
 * across your application using the reusable LocationAjax utility.
 */

// ============================================================================
// Example 1: Basic Implementation (like in Company Settings)
// ============================================================================

$(document).ready(function() {
    // Initialize with default settings
    LocationAjax.init({
        countrySelector: '#country_id',
        stateSelector: '#state_id',
        citySelector: '#city_id',
        statesRoute: '/team/settings/company/states/',
        citiesRoute: '/team/settings/company/cities/'
    });
});

// ============================================================================
// Example 2: Custom Implementation for Branch Module
// ============================================================================

$(document).ready(function() {
    // Initialize with custom routes for branch module
    LocationAjax.init({
        countrySelector: '#branch_country_id',
        stateSelector: '#branch_state_id',
        citySelector: '#branch_city_id',
        statesRoute: '/team/settings/branches/states/',
        citiesRoute: '/team/settings/branches/cities/',
        loadingText: 'Loading options...',
        selectText: 'Choose',
        noDataText: 'No options available'
    });
});

// ============================================================================
// Example 3: Implementation for Student Module with Custom Selectors
// ============================================================================

$(document).ready(function() {
    // Initialize for student address
    LocationAjax.init({
        countrySelector: '.student-country-select',
        stateSelector: '.student-state-select',
        citySelector: '.student-city-select',
        statesRoute: '/student/location/states/',
        citiesRoute: '/student/location/cities/'
    });
});

// ============================================================================
// Example 4: Implementation for Partner Module with Pre-filled Data
// ============================================================================

$(document).ready(function() {
    // Initialize location AJAX
    LocationAjax.init({
        countrySelector: '#partner_country_id',
        stateSelector: '#partner_state_id',
        citySelector: '#partner_city_id',
        statesRoute: '/partner/location/states/',
        citiesRoute: '/partner/location/cities/'
    });

    // Pre-fill values for edit mode
    const existingValues = {
        country_id: '101',  // India
        state_id: '4030',   // Gujarat
        city_id: '133024'   // Ahmedabad
    };

    LocationAjax.setSelectedValues(existingValues);
});

// ============================================================================
// Example 5: Multiple Location Sets on Same Page
// ============================================================================

$(document).ready(function() {
    // Initialize for permanent address
    LocationAjax.init({
        countrySelector: '#permanent_country_id',
        stateSelector: '#permanent_state_id',
        citySelector: '#permanent_city_id',
        statesRoute: '/location/states/',
        citiesRoute: '/location/cities/'
    });

    // Initialize for current address (you'd need to create a separate instance)
    // Note: For multiple instances, you'd need to modify the LocationAjax to support multiple instances
});

// ============================================================================
// Example 6: Getting Selected Values Programmatically
// ============================================================================

$(document).ready(function() {
    LocationAjax.init({
        countrySelector: '#country_id',
        stateSelector: '#state_id',
        citySelector: '#city_id',
        statesRoute: '/location/states/',
        citiesRoute: '/location/cities/'
    });

    // Get selected values when form is submitted
    $('#myForm').on('submit', function(e) {
        const selectedValues = LocationAjax.getSelectedValues();
        console.log('Selected Location:', selectedValues);
        
        // Validate that required fields are selected
        if (!selectedValues.country_id || !selectedValues.state_id || !selectedValues.city_id) {
            e.preventDefault();
            alert('Please select all location fields');
            return false;
        }
    });
});

// ============================================================================
// Required HTML Structure Examples
// ============================================================================

/*
<!-- Basic HTML structure for location dropdowns -->
<div class="location-selectors">
    <div class="form-group">
        <label for="country_id">Country</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="state_id">State</label>
        <select id="state_id" name="state_id" class="form-control">
            <option value="">Select State</option>
        </select>
    </div>

    <div class="form-group">
        <label for="city_id">City</label>
        <select id="city_id" name="city_id" class="form-control">
            <option value="">Select City</option>
        </select>
    </div>
</div>

<!-- Using Blade components (recommended) -->
<x-team.forms.select 
    name="country_id" 
    label="Country" 
    :options="$countries"
    :selected="old('country_id')"
    placeholder="Select Country"
/>

<x-team.forms.select 
    name="state_id" 
    label="State" 
    :options="[]"
    :selected="old('state_id')"
    placeholder="Select State"
/>

<x-team.forms.select 
    name="city_id" 
    label="City" 
    :options="[]"
    :selected="old('city_id')"
    placeholder="Select City"
/>
*/

// ============================================================================
// Required Controller Methods Examples
// ============================================================================

/*
// Add these methods to your controller for AJAX endpoints

public function getStatesByCountry($countryId)
{
    $states = State::where('country_id', $countryId)
                  ->orderBy('name')
                  ->get(['id', 'name']);
    
    return response()->json($states);
}

public function getCitiesByState($stateId)
{
    $cities = City::where('state_id', $stateId)
                 ->orderBy('name')
                 ->get(['id', 'name']);
    
    return response()->json($cities);
}
*/

// ============================================================================
// Required Routes Examples
// ============================================================================

/*
// Add these routes to your routes file

Route::get('states/{country}', [YourController::class, 'getStatesByCountry'])->name('states');
Route::get('cities/{state}', [YourController::class, 'getCitiesByState'])->name('cities');
*/
