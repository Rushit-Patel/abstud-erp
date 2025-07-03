# Location AJAX - Reusable Country/State/City Dropdowns

This guide explains how to implement dependent location dropdowns (Country → State → City) in any module across your Laravel application using jQuery and AJAX.

## Files Structure

```
resources/js/team/
├── location-ajax.js           # Main reusable utility
├── location-ajax-examples.js  # Usage examples
└── vendors/
    └── jquery-3.7.1.slim.min.js
```

## Quick Start

### 1. Include Required Files

In your Blade view, add the jQuery and LocationAjax scripts:

```blade
@push('scripts')
@vite(['resources/js/team/vendors/jquery-3.7.1.slim.min.js', 'resources/js/team/location-ajax.js'])
<script>
$(document).ready(function() {
    LocationAjax.init({
        countrySelector: '#country_id',
        stateSelector: '#state_id', 
        citySelector: '#city_id',
        statesRoute: '{{ route("your.module.states", ":countryId") }}'.replace(':countryId', ''),
        citiesRoute: '{{ route("your.module.cities", ":stateId") }}'.replace(':stateId', '')
    });
});
</script>
@endpush
```

### 2. HTML Structure

Use Blade components for consistent styling:

```blade
<!-- Country Dropdown -->
<x-team.forms.select 
    name="country_id" 
    label="Country" 
    :options="$countries"
    :selected="old('country_id')"
    placeholder="Select Country"
    required="true"
/>

<!-- State Dropdown -->
<x-team.forms.select 
    name="state_id" 
    label="State" 
    :options="[]"
    :selected="old('state_id')"
    placeholder="Select State"
    required="true"
/>

<!-- City Dropdown -->
<x-team.forms.select 
    name="city_id" 
    label="City" 
    :options="[]"
    :selected="old('city_id')"
    placeholder="Select City"
    required="true"
/>
```

### 3. Controller Methods

Add these methods to your controller:

```php
/**
 * Get states by country ID for AJAX calls
 */
public function getStatesByCountry($countryId)
{
    $states = State::where('country_id', $countryId)
                  ->orderBy('name')
                  ->get(['id', 'name']);
    
    return response()->json($states);
}

/**
 * Get cities by state ID for AJAX calls
 */
public function getCitiesByState($stateId)
{
    $cities = City::where('state_id', $stateId)
                 ->orderBy('name')
                 ->get(['id', 'name']);
    
    return response()->json($cities);
}
```

### 4. Routes

Add AJAX routes to your routes file:

```php
Route::get('states/{country}', [YourController::class, 'getStatesByCountry'])->name('states');
Route::get('cities/{state}', [YourController::class, 'getCitiesByState'])->name('cities');
```

## Configuration Options

```javascript
LocationAjax.init({
    countrySelector: '#country_id',        // Country dropdown selector
    stateSelector: '#state_id',            // State dropdown selector  
    citySelector: '#city_id',              // City dropdown selector
    statesRoute: '/module/states/',        // States AJAX endpoint
    citiesRoute: '/module/cities/',        // Cities AJAX endpoint
    loadingText: 'Loading...',             // Loading text
    selectText: 'Select',                  // Default select text
    noDataText: 'No data available'        // No data text
});
```

## Advanced Usage

### Pre-filling Values (Edit Mode)

```javascript
// For edit forms, set existing values
LocationAjax.setSelectedValues({
    country_id: '{{ $record->country_id }}',
    state_id: '{{ $record->state_id }}',
    city_id: '{{ $record->city_id }}'
});
```

### Getting Selected Values

```javascript
// Get current selected values
const values = LocationAjax.getSelectedValues();
console.log(values); // { country_id: '1', state_id: '23', city_id: '456' }
```

### Form Validation

```javascript
$('#myForm').on('submit', function(e) {
    const values = LocationAjax.getSelectedValues();
    if (!values.country_id || !values.state_id || !values.city_id) {
        e.preventDefault();
        alert('Please select all location fields');
        return false;
    }
});
```

## Module Examples

### Company Settings (Current Implementation)
- File: `resources/views/team/settings/company/edit.blade.php`
- Routes: `routes/Team/systemSettings.php`
- Controller: `app/Http/Controllers/Team/SystemSettings/CompanySettingsController.php`

### Student Module Example
```javascript
LocationAjax.init({
    countrySelector: '#student_country_id',
    stateSelector: '#student_state_id',
    citySelector: '#student_city_id',
    statesRoute: '/student/location/states/',
    citiesRoute: '/student/location/cities/'
});
```

### Partner Module Example
```javascript
LocationAjax.init({
    countrySelector: '#partner_country_id',
    stateSelector: '#partner_state_id',
    citySelector: '#partner_city_id',
    statesRoute: '/partner/location/states/',
    citiesRoute: '/partner/location/cities/'
});
```

### Branch Module Example
```javascript
LocationAjax.init({
    countrySelector: '#branch_country_id',
    stateSelector: '#branch_state_id',
    citySelector: '#branch_city_id',
    statesRoute: '/team/settings/branches/states/',
    citiesRoute: '/team/settings/branches/cities/'
});
```

## Features

- ✅ **Reusable**: Use in any module with minimal configuration
- ✅ **jQuery-based**: Uses jQuery for AJAX calls as requested
- ✅ **Error Handling**: Comprehensive error handling and user feedback
- ✅ **Loading States**: Shows loading indicators during AJAX requests
- ✅ **Form Integration**: Easy integration with existing forms
- ✅ **Edit Mode Support**: Pre-fill values for edit forms
- ✅ **Validation Ready**: Get selected values for form validation
- ✅ **Toast Integration**: Integrates with existing toast notification system
- ✅ **Consistent UI**: Works with existing Blade components

## Troubleshooting

### Common Issues

1. **AJAX 404 Errors**: Check that routes are properly defined and controller methods exist
2. **jQuery Not Loaded**: Ensure jQuery is loaded before LocationAjax
3. **Selectors Not Found**: Verify HTML element IDs match the configured selectors
4. **CSRF Issues**: Add CSRF token if using POST requests

### Debug Mode

Enable console logging to debug issues:

```javascript
// Add this to see debug information
console.log('LocationAjax initialized with config:', config);
```

## Future Enhancements

- Support for multiple location sets on same page
- Configurable CSRF token handling
- Support for custom data formatting
- Integration with Select2 or similar libraries
- Caching of loaded data to reduce API calls
