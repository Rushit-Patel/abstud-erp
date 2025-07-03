@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Cities', 'url' => route('team.settings.cities.index')],
    ['title' => 'Edit City']
];
@endphp

<x-team.layout.app title="Edit City" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Edit City
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Update city
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.cities.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-black-left"></i>
                        Back to Cities
                    </a>
                </div>
            </div>

            <form action="{{ route('team.settings.cities.update' ,$city) }}" method="POST">
                @csrf
                <div class="grid lg:grid-cols-2 gap-5 lg:gap-7.5">
                    <!-- Basic Information -->
                    <div class="col-span-1">
                        <x-team.card title="Basic Information">
                            <div class="grid gap-5">
                                <!-- Country Selection -->
                                <div class="flex flex-col gap-1">
                                    <label class="kt-form-label font-normal text-mono required">Country</label>
                                    <select name="country_id" id="country_id" class="kt-select" required>
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $city?->state?->country_id) == $country->id ? 'selected' : '' }}>
                                                {{ $country->icon }} {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- State Selection -->
                                <div class="flex flex-col gap-1">
                                    <label class="kt-form-label font-normal text-mono required">State/Province</label>
                                    <select name="state_id" id="state_id" class="kt-select" required disabled>
                                        <option value="">Select State First</option>
                                    </select>
                                    @error('state_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City Name -->
                                <x-team.forms.input 
                                    name="name" 
                                    label="City Name" 
                                    type="text" 
                                    placeholder="Enter city name" 
                                    :value="old('name')" 
                                    required />
                            </div>
                        </x-team.card>
                    </div>

                    <!-- Status Settings -->
                    <div class="col-span-1">
                        <x-team.card title="Status Settings">
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label font-normal text-mono">Status</label>
                                <label class="kt-label">
                                    <input class="kt-checkbox kt-checkbox-sm" 
                                        name="is_active" 
                                        type="checkbox" 
                                        value="1" 
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                    />
                                    <span class="kt-checkbox-label">
                                        Active (Enable this city for selection)
                                    </span>
                                </label>
                            </div>
                        </x-team.card>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-3 mt-7.5">
                    <a href="{{ route('team.settings.cities.index') }}" class="kt-btn kt-btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-check"></i>
                        Create City
                    </button>
                </div>
            </form>
        </div>

        {{-- <script>
            document.getElementById('country_id').addEventListener('change', function() {
                const countryId = this.value;
                const stateSelect = document.getElementById('state_id');
                
                // Reset state dropdown
                stateSelect.innerHTML = '<option value="">Loading...</option>';
                stateSelect.disabled = true;
                
                if (countryId) {
                    // Fetch states for selected country
                    fetch(`{{ route('team.settings.cities.states-by-country') }}?country_id=${countryId}`)
                        .then(response => response.json())
                        .then(states => {
                            stateSelect.innerHTML = '<option value="">Select State</option>';
                            
                            states.forEach(state => {
                                const option = document.createElement('option');
                                option.value = state.id;
                                option.textContent = state.name;
                                if ({{ old('state_id', 0) }} == state.id) {
                                    option.selected = true;
                                }
                                stateSelect.appendChild(option);
                            });
                            
                            stateSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching states:', error);
                            stateSelect.innerHTML = '<option value="">Error loading states</option>';
                        });
                } else {
                    stateSelect.innerHTML = '<option value="">Select Country First</option>';
                }
            });

            // Trigger change event if country is pre-selected (for validation errors)
            @if(old('country_id'))
                document.getElementById('country_id').dispatchEvent(new Event('change'));
            @endif
        </script> --}}
     
     <script>
    document.addEventListener('DOMContentLoaded', function () {
        const countrySelect = document.getElementById('country_id');
        const stateSelect = document.getElementById('state_id');
        const stateUrl = "{{ route('team.settings.cities.states-by-country') }}";

        function loadStates(countryId, preselectStateId = null) {
            stateSelect.innerHTML = '<option value="">Loading...</option>';
            stateSelect.disabled = true;

            fetch(`${stateUrl}?country_id=${countryId}`)
                .then(response => response.json())
                .then(states => {
                    stateSelect.innerHTML = '<option value="">Select State</option>';
                    states.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state.id;
                        option.textContent = state.name;

                        if (preselectStateId && parseInt(preselectStateId) === state.id) {
                            option.selected = true;
                        }

                        stateSelect.appendChild(option);
                    });

                    stateSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching states:', error);
                    stateSelect.innerHTML = '<option value="">Error loading states</option>';
                });
        }

        // When country is changed
        countrySelect.addEventListener('change', function () {
            const countryId = this.value;
            if (countryId) {
                loadStates(countryId);
            } else {
                stateSelect.innerHTML = '<option value="">Select State</option>';
                stateSelect.disabled = true;
            }
        });

        // On page load, if editing
        if (selectedCountryId) {
            loadStates(selectedCountryId, selectedStateId);
        }
    });
</script>


    </x-slot>
</x-team.layout.app>
