
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
});