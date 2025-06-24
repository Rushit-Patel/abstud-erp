@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'User Management', 'url' => route('team.settings.users.index')],
    ['title' => 'Edit User']
];
@endphp

<x-team.layout.app title="Edit User" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Edit User
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Modify user information and permissions
                    </div>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-content">
                    <div class="text-center py-10">
                        <i class="ki-filled ki-profile-circle text-4xl text-muted-foreground mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">User Editing Coming Soon</h3>
                        <p class="text-secondary-foreground">This feature is under development.</p>
                        <a href="{{ route('team.settings.users.index') }}" class="kt-btn kt-btn-primary mt-4">
                            Back to Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-team.layout.app>
