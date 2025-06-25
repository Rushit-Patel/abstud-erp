@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Company Settings']
];
@endphp

<x-team.layout.app title="Company Settings" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <!-- Page Header -->
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Company Settings
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage your company information and system settings
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.company.edit') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-notepad-edit"></i>
                        Edit Settings
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="kt-alert kt-alert-success mb-5">
                    <div class="kt-alert-content">
                        <div class="kt-alert-title">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- begin: grid -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
                <div class="col-span-1">
                    <div class="grid gap-5 lg:gap-7.5">
                        <!-- Company Information Card -->
                        <div class="kt-card min-w-full">
                            <div class="kt-card-header">
                                <h3 class="kt-card-title">
                                    Company Information
                                </h3>
                            </div>
                            <div class="kt-card-table kt-scrollable-x-auto pb-3">
                                <table class="kt-table align-middle text-sm text-muted-foreground">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 min-w-28 text-secondary-foreground font-normal">
                                                Logo
                                            </td>
                                            <td class="py-2 text-secondary-foreground font-normal min-w-60 text-sm">
                                                Company Logo (150x150px)
                                            </td>
                                            <td class="py-2 text-center">
                                                <div class="flex justify-center items-center">
                                                    @if($company && $company->company_logo)
                                                        <div class="size-16 rounded-lg overflow-hidden border border-input">
                                                            <img src="{{ Storage::url($company->company_logo) }}" 
                                                                 alt="{{ $company->company_name }}" 
                                                                 class="w-full h-full object-cover">
                                                        </div>
                                                    @else
                                                        <div class="size-16 rounded-lg border-2 border-dashed border-input flex items-center justify-center bg-background">
                                                            <i class="ki-filled ki-picture text-xl text-muted-foreground"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-secondary-foreground font-normal">
                                                Name
                                            </td>
                                            <td class="py-2 text-foreground font-normal text-sm">
                                                {{ $company->company_name ?? 'Not set' }}
                                            </td>
                                            <td class="py-2 text-center">
                                                <a class="kt-btn kt-btn-icon kt-btn-sm kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-secondary-foreground font-normal">
                                                Email
                                            </td>
                                            <td class="py-3 text-foreground font-normal">
                                                {{ $company->email ?? 'Not set' }}
                                            </td>
                                            <td class="py-3 text-center">
                                                <a class="kt-btn kt-btn-icon kt-btn-sm kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-secondary-foreground font-normal">
                                                Phone
                                            </td>
                                            <td class="py-3 text-secondary-foreground text-sm font-normal">
                                                {{ $company->phone ?? 'Not set' }}
                                            </td>
                                            <td class="py-3 text-center">
                                                <a class="kt-btn kt-btn-icon kt-btn-sm kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-secondary-foreground font-normal">
                                                Website
                                            </td>
                                            <td class="py-3 text-secondary-foreground text-sm font-normal">
                                                @if($company->website_url)
                                                    <a href="{{ $company->website_url }}" target="_blank" class="text-primary hover:underline">
                                                        {{ $company->website_url }}
                                                    </a>
                                                @else
                                                    Not set
                                                @endif
                                            </td>
                                            <td class="py-3 text-center">
                                                <a class="kt-btn kt-btn-icon kt-btn-sm kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3">
                                                Address
                                            </td>
                                            <td class="py-3 text-secondary-foreground text-sm font-normal">
                                                @if($company && $company->company_address)
                                                    {{ $company->company_address }}
                                                    @if($company->city || $company->state || $company->country)
                                                        <br>
                                                        {{ collect([$company->city, $company->state, $company->country])->filter()->implode(', ') }}
                                                        @if($company->postal_code)
                                                            {{ $company->postal_code }}
                                                        @endif
                                                    @endif
                                                @else
                                                    No address set
                                                @endif
                                            </td>
                                            <td class="py-3 text-center">
                                                @if($company && $company->company_address)
                                                    <a class="kt-btn kt-btn-icon kt-btn-sm kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                        <i class="ki-filled ki-notepad-edit"></i>
                                                    </a>
                                                @else
                                                    <a class="kt-link kt-link-underlined kt-link-dashed" href="{{ route('team.settings.company.edit') }}">
                                                        Add
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- System Settings Card -->
                        <div class="kt-card min-w-full">
                            <div class="kt-card-header">
                                <h3 class="kt-card-title">
                                    System Configuration
                                </h3>
                                <div class="flex items-center gap-2">
                                    <label class="kt-label">
                                        Setup Completed
                                        <input {{ $company && $company->is_setup_completed ? 'checked' : '' }} 
                                               class="kt-switch kt-switch-sm" 
                                               name="setup_status" 
                                               type="checkbox" 
                                               value="1" 
                                               disabled>
                                    </label>
                                </div>
                            </div>
                            <div class="kt-card-table kt-scrollable-x-auto pb-3">
                                <table class="kt-table align-middle text-sm text-muted-foreground">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 min-w-36 text-secondary-foreground font-normal">
                                                Timezone
                                            </td>
                                            <td class="py-2 min-w-60">
                                                <span class="text-foreground font-normal text-sm">
                                                    {{ config('app.timezone', 'UTC') }}
                                                </span>
                                            </td>
                                            <td class="py-2 max-w-16 text-end">
                                                <a class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-secondary-foreground font-normal">
                                                Date Format
                                            </td>
                                            <td class="py-2 text-secondary-foreground font-normal">
                                                Y-m-d ({{ now()->format('Y-m-d') }})
                                            </td>
                                            <td class="py-2 text-end">
                                                <a class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3.5 text-secondary-foreground font-normal">
                                                Time Format
                                            </td>
                                            <td class="py-3.5 text-secondary-foreground font-normal">
                                                H:i:s ({{ now()->format('H:i:s') }})
                                            </td>
                                            <td class="py-3 text-end">
                                                <a class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-secondary-foreground font-normal">
                                                Currency
                                            </td>
                                            <td class="py-2 text-foreground font-normal">
                                                USD ($)
                                            </td>
                                            <td class="py-2 text-end">
                                                <a class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 text-secondary-foreground font-normal">
                                                Language
                                            </td>
                                            <td class="py-3 text-secondary-foreground font-normal">
                                                English (en)
                                            </td>
                                            <td class="py-3 text-end">
                                                <a class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost kt-btn-primary" href="{{ route('team.settings.company.edit') }}">
                                                    <i class="ki-filled ki-notepad-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="grid gap-5 lg:gap-7.5">
                        <!-- Setup Progress Card -->
                        <div class="kt-card flex-col gap-5 justify-between bg-gradient-to-br from-primary/5 to-primary/10 border-primary/20 pt-5 lg:pt-10 px-5">
                            <div class="text-center">
                                <div class="mb-4">
                                    <div class="size-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="ki-filled ki-setting-3 text-2xl text-primary"></i>
                                    </div>
                                </div>
                                <h3 class="text-mono text-lg font-semibold leading-6 mb-1.5">
                                    Company Setup
                                    @if($company && $company->is_setup_completed)
                                        <span class="kt-badge kt-badge-success kt-badge-sm ml-2">Completed</span>
                                    @else
                                        <span class="kt-badge kt-badge-warning kt-badge-sm ml-2">Incomplete</span>
                                    @endif
                                </h3>
                                <span class="text-secondary-foreground text-sm block mb-5">
                                    @if($company && $company->is_setup_completed)
                                        Your company profile is fully configured and ready.
                                    @else
                                        Complete your company profile to get started.
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="kt-card">
                            <div class="kt-card-header">
                                <h3 class="kt-card-title">
                                    Quick Actions
                                </h3>
                            </div>
                            <div class="kt-card-content">
                                <div class="grid gap-2.5">
                                    <div class="flex items-center justify-between flex-wrap border border-border rounded-xl gap-2 px-3.5 py-2.5 hover:bg-accent/50 transition-colors">
                                        <div class="flex items-center flex-wrap gap-3.5">
                                            <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                                <i class="ki-filled ki-geolocation text-primary"></i>
                                            </div>                                            <div class="flex flex-col">
                                                <a class="text-sm font-medium text-mono hover:text-primary mb-px" href="{{ route('team.settings.branches.index') }}">
                                                    Manage Branches
                                                </a>
                                                <span class="text-xs text-secondary-foreground">
                                                    Add and configure branch locations
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('team.settings.branches.index') }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                            <i class="ki-filled ki-right"></i>
                                        </a>
                                    </div>

                                    <div class="flex items-center justify-between flex-wrap border border-border rounded-xl gap-2 px-3.5 py-2.5 hover:bg-accent/50 transition-colors">
                                        <div class="flex items-center flex-wrap gap-3.5">
                                            <div class="size-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                                <i class="ki-filled ki-profile-circle text-green-600"></i>
                                            </div>                                            <div class="flex flex-col">
                                                <a class="text-sm font-medium text-mono hover:text-primary mb-px" href="{{ route('team.settings.users.index') }}">
                                                    User Management
                                                </a>
                                                <span class="text-xs text-secondary-foreground">
                                                    Manage user accounts and permissions
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('team.settings.users.index') }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                            <i class="ki-filled ki-right"></i>
                                        </a>
                                    </div>

                                    <div class="flex items-center justify-between flex-wrap border border-border rounded-xl gap-2 px-3.5 py-2.5 hover:bg-accent/50 transition-colors">
                                        <div class="flex items-center flex-wrap gap-3.5">
                                            <div class="size-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                                <i class="ki-filled ki-setting-2 text-blue-600"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <a class="text-sm font-medium text-mono hover:text-primary mb-px" href="{{ route('team.settings.index') }}">
                                                    System Settings
                                                </a>
                                                <span class="text-xs text-secondary-foreground">
                                                    Configure system preferences
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('team.settings.index') }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                            <i class="ki-filled ki-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: grid -->
        </div>
    </x-slot>
</x-team.layout.app>
