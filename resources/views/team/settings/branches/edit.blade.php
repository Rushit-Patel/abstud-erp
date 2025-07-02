@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Branch Management', 'url' => route('team.settings.branches.index')],
    ['title' => 'Edit Branch']
];
@endphp

<x-team.layout.app title="Edit Branch" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Edit Branch: {{ $branch->branch_name }}
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Update branch information and settings
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.branches.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-left"></i>
                        Back to Branches
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('team.settings.branches.update', $branch) }}" class="kt-card">
                @csrf
                @method('PUT')
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Branch Information</h3>
                </div>
                <div class="kt-card-content">
                    <div class="grid lg:grid-cols-2 gap-5">
                        <!-- Branch Name -->
                        <x-team.forms.input 
                            name="branch_name" 
                            label="Branch Name" 
                            type="text" 
                            :required="true"
                            placeholder="Enter branch name" 
                            :value="old('branch_name', $branch->branch_name)" />

                        <!-- Branch Code -->
                        <x-team.forms.input 
                            name="branch_code" 
                            label="Branch Code" 
                            type="text" 
                            :required="true"
                            placeholder="Enter unique branch code" 
                            :value="old('branch_code', $branch->branch_code)" />

                        <!-- Manager Name -->
                        <x-team.forms.input 
                            name="manager_name" 
                            label="Manager Name" 
                            type="text" 
                            placeholder="Enter manager name" 
                            :value="old('manager_name', $branch->manager_name)" />

                        <!-- Phone -->
                        <x-team.forms.input 
                            name="phone" 
                            label="Phone Number" 
                            type="tel" 
                            placeholder="Enter phone number" 
                            :value="old('phone', $branch->phone)" />

                        <!-- Email -->
                        <x-team.forms.input 
                            name="email" 
                            label="Email Address" 
                            type="email" 
                            placeholder="Enter email address" 
                            :value="old('email', $branch->email)" />

                        <!-- Address -->
                        <div class="lg:col-span-2">
                            <x-team.forms.input 
                                name="address" 
                                label="Address" 
                                type="text" 
                                placeholder="Enter complete address" 
                                :value="old('address', $branch->address)" />
                        </div>

                        <!-- City -->
                        <x-team.forms.input 
                            name="city" 
                            label="City" 
                            type="text" 
                            placeholder="Enter city" 
                            :value="old('city', $branch->city)" />

                        <!-- State -->
                        <x-team.forms.input 
                            name="state" 
                            label="State/Province" 
                            type="text" 
                            placeholder="Enter state or province" 
                            :value="old('state', $branch->state)" />

                        <!-- Country -->
                        <x-team.forms.input 
                            name="country" 
                            label="Country" 
                            type="text" 
                            placeholder="Enter country" 
                            :value="old('country', $branch->country)" />

                        <!-- Postal Code -->
                        <x-team.forms.input 
                            name="postal_code" 
                            label="Postal Code" 
                            type="text" 
                            placeholder="Enter postal/zip code" 
                            :value="old('postal_code', $branch->postal_code)" />

                        <!-- Status -->
                        <div class="lg:col-span-2">
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label font-normal text-mono">Status</label>
                                <label class="kt-label">
                                    <input class="kt-checkbox kt-checkbox-sm" 
                                        name="is_active" 
                                        type="checkbox" 
                                        value="1" 
                                        {{ old('is_active', $branch->is_active) ? 'checked' : '' }}
                                    />
                                    <span class="kt-checkbox-label">
                                        Active (Enable this branch for operations)
                                    </span>
                                </label>
                            </div>
                        </div>

                        @if($branch->is_main_branch)
                            <div class="lg:col-span-2">
                                <div class="kt-alert kt-alert-info">
                                    <div class="kt-alert-icon">
                                        <i class="ki-filled ki-information"></i>
                                    </div>
                                    <div class="kt-alert-content">
                                        <div class="kt-alert-title">Main Branch</div>
                                        <div class="kt-alert-description">
                                            This is the main branch of your organization and cannot be deactivated.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="kt-card-footer">
                    <div class="flex justify-end gap-2.5">
                        <a href="{{ route('team.settings.branches.index') }}" class="kt-btn kt-btn-secondary">
                            Cancel
                        </a>
                        <x-team.forms.button type="submit">
                            <i class="ki-filled ki-check"></i>
                            Update Branch
                        </x-team.forms.button>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global toast handling is now managed in the app layout
            
            // Branch edit-specific functionality can go here
            // Example: Form validation, auto-save, etc.
        });
    </script>
    @endpush
</x-team.layout.app>
