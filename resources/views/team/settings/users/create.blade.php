@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'User Management', 'url' => route('team.settings.users.index')],
    ['title' => 'Add User']
];
@endphp

<x-team.layout.app title="Add User" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Add New User
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Create a new user account with role and permissions
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.users.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-left"></i>
                        Back to Users
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('team.settings.users.store') }}" class="kt-card">
                @csrf
                <div class="kt-card-header">
                    <h3 class="kt-card-title">User Information</h3>
                </div>
                <div class="kt-card-content">
                    <div class="grid lg:grid-cols-2 gap-5">
                        <!-- Full Name -->
                        <x-team.forms.input 
                            name="name" 
                            label="Full Name" 
                            type="text" 
                            :required="true"
                            placeholder="Enter full name" 
                            :value="old('name')" />

                        <!-- Email -->
                        <x-team.forms.input 
                            name="email" 
                            label="Email Address" 
                            type="email" 
                            :required="true"
                            placeholder="Enter email address" 
                            :value="old('email')" />

                        <!-- Phone -->
                        <x-team.forms.input 
                            name="phone" 
                            label="Phone Number" 
                            type="tel" 
                            placeholder="Enter phone number" 
                            :value="old('phone')" />

                        <!-- Branch -->
                        <x-team.forms.select-picker
                            name="branch_id"
                            label="Branch"
                            :options="$branches"
                            :selected="old('branch_id')"
                            placeholder="Select branch"
                            :required="true"
                            :searchable="true" />

                        <!-- Role -->
                        <x-team.forms.select-picker
                            name="role_id"
                            label="Role"
                            :options="$roles"
                            :selected="old('role_id')"
                            placeholder="Select role"
                            :required="true"
                            :searchable="true" />

                        <!-- Password -->
                        <x-team.forms.input 
                            name="password" 
                            label="Password" 
                            type="password" 
                            :required="true"
                            placeholder="Enter secure password" />

                        <!-- Confirm Password -->
                        <x-team.forms.input 
                            name="password_confirmation" 
                            label="Confirm Password" 
                            type="password" 
                            :required="true"
                            placeholder="Confirm password" />

                        <!-- Status -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="is_active" name="is_active" class="kt-checkbox" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label for="is_active" class="kt-form-label mb-0">
                                    Active User
                                    <span class="text-sm text-secondary-foreground block">User can login and access the system</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-card-footer">
                    <div class="flex justify-end gap-2.5">
                        <a href="{{ route('team.settings.users.index') }}" class="kt-btn kt-btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="kt-btn kt-btn-primary">
                            <i class="ki-filled ki-check"></i>
                            Create User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>
</x-team.layout.app>
