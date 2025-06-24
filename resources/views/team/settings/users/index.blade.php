@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'User Management']
];
@endphp

<x-team.layout.app title="User Management" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        User Management
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage user accounts and permissions
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.users.create') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add User
                    </a>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Users</h3>
                </div>
                <div class="kt-card-content">
                    <div class="text-center py-10">
                        <i class="ki-filled ki-profile-circle text-4xl text-muted-foreground mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">User Management Coming Soon</h3>
                        <p class="text-secondary-foreground">This feature is under development.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-team.layout.app>
