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
        </div>        <div class="kt-container-fixed">
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
        </div>
    </x-slot>
</x-team.layout.app>