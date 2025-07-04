@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Client', 'url' => route('team.lead.index')],
    ['title' => 'Create Client']
];
@endphp

<x-team.layout.app title="Create Client" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Create New Client
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Add a new lead to the system
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.lead.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>

            <x-team.card title="Client Information" headerClass="">
                <form action="{{ route('team.lead.store') }}" method="POST" class="form">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 py-5">
                        <div class="col-span-1">
                            <x-team.card title="Personal Details">
                                <div class="grid gap-5">
                                    <!-- Country Name -->
                                    <x-team.forms.input
                                        name="first_name"
                                        label="First Name"
                                        type="text"
                                        placeholder="Enter first name"
                                        :value="old('first_name')"
                                        required />

                                        <x-team.forms.input
                                            name="middle_name"
                                            label="Middle Name"
                                            type="text"
                                            placeholder="Enter middle_name"
                                            :value="old('middle_name')" />

                                        <!-- Example: Phone -->
                                        <x-team.forms.input
                                            name="last_name"
                                            label="Last Name"
                                            type="text"
                                            placeholder="Enter last name"
                                            :value="old('last_name')"
                                            required/>
                                        <x-team.forms.input
                                            name="mobile_no"
                                            label="Mobile no"
                                            type="text"
                                            placeholder="Enter mobile no"
                                            :value="old('mobile_no')"
                                            required/>
                                        <x-team.forms.input
                                            name="email_id"
                                            label="Email id"
                                            type="text"
                                            placeholder="Enter email "
                                            :value="old('email_id')"
                                            required/>
                                        <!-- Country -->
                                        <x-team.forms.select
                                                name="country_id"
                                                label="Country *"
                                                :options="$countries"
                                                :selected="old('country_id')"
                                                placeholder="Select Country"
                                                searchable="true"
                                                required
                                            />

                                        <x-team.forms.select
                                                name="state_id"
                                                label="State/Province"
                                                :options="[]"
                                                :selected="old('state_id')"
                                                placeholder="Select State"
                                                searchable="true"
                                                required
                                            />

                                            <x-team.forms.select
                                                name="city_id"
                                                label="City"
                                                :options="[]"
                                                :selected="old('city_id')"
                                                placeholder="Select City"
                                                required
                                                searchable="true"
                                            />

                                            <x-team.forms.input
                                                name="whatsapp_no"
                                                label="Whatsapp no"
                                                type="text"
                                                placeholder="Enter whatsapp no"
                                                :value="old('whatsapp_no')"
                                                required/>

                                            <x-team.forms.select
                                                name="source"
                                                label="Source"
                                                :options="$sources"
                                                :selected="old('source')"
                                                placeholder="Select source"
                                                required
                                                searchable="true"
                                            />
                                            <x-team.forms.select
                                                name="lead_type"
                                                label="Lead Type"
                                                :options="$leadTypes"
                                                :selected="old('lead_type')"
                                                placeholder="Select lead type"
                                                required
                                                searchable="true"
                                            />

                                            <x-team.forms.textarea
                                                name="address"
                                                label="Address"
                                                :value="old('address')"
                                                placeholder="Enter address"
                                                required
                                            />


                                    </div>
                            </x-team.card>
                        </div>

                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-2.5 pt-5 border-t border-gray-200">
                        <a href="{{ route('team.lead.index') }}" class="kt-btn kt-btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="kt-btn kt-btn-primary">
                            <i class="ki-filled ki-check"></i>
                            Create Client
                        </button>
                    </div>
                </form>
            </x-team.card>
        </div>
    </x-slot>
    @push('scripts')
    @vite(['resources/js/team/location-ajax.js'])
    <script>
        $(document).ready(function() {
            // Initialize Location AJAX for country/state/city dropdowns
            LocationAjax.init({
                countrySelector: '#country_id',
                stateSelector: '#state_id',
                citySelector: '#city_id',
                statesRoute: '{{ route("team.settings.company.states", ":countryId") }}'.replace(':countryId', ''),
                citiesRoute: '{{ route("team.settings.company.cities", ":stateId") }}'.replace(':stateId', '')
            });
        });
    </script>

    @endpush
</x-team.layout.app>
