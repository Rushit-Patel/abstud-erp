@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Company Settings']
];
@endphp
<x-team.layout.app  title="Company Settings" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Company Settings
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Central Hub for System Customization
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container-fixed">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-7.5">
                {{-- Company Info Card --}}
                <x-team.cards.setting-card 
                    icon="ki-office-bag" 
                    title="Company Info" 
                    description="Manage your company's basic information, contact details, and business profile settings."
                    link="{{ route('team.settings.company.index') ?? '#' }}"
                />
                
                {{-- Manage Branch Card --}}
                <x-team.cards.setting-card 
                    icon="ki-geolocation" 
                    title="Manage Branch" 
                    description="Add, edit, and organize branch locations, assign managers, and configure branch-specific settings."
                    link="{{ route('team.settings.branches.index') ?? '#' }}"
                />
                
                {{-- Manage User Account Card --}}
                <x-team.cards.setting-card 
                    icon="ki-profile-circle" 
                    title="Manage User Account" 
                    description="Control user permissions, roles, account settings, and access management for team members."
                    link="{{ route('team.settings.users.index') ?? '#' }}"
                />
            </div>
            <div class="flex grow justify-center pt-5 pb-5 lg:pt-7.5 lg:pb-7.5">
                <a class="kt-link kt-link-underlined kt-link-dashed" href="javaScript:void(0);">
                    Other Master Settings
                </a>
            </div>
            <div class="grid sm:grid-cols-4 xl:grid-cols-6 gap-5 mb-2">
                <x-team.cards.setting-sm-card 
                    title="Country" 
                    icon="geolocation"
                    link="{{ route('team.settings.countries.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="State" 
                    icon="map"
                    link="{{ route('team.settings.states.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="City" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Lead Type" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Purpose" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Source" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Lead Status" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Lead Sub Status" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Destination Country" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
                <x-team.cards.setting-sm-card 
                    title="Coaching" 
                    icon="map"
                    link="{{ route('team.settings.cities.index') ?? '#' }}"
                />
            </div>
        </div>
    </x-slot>
</x-team.layout.app>