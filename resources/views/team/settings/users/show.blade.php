@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'User Management', 'url' => route('team.settings.users.index')],
    ['title' => $user->name]
];
@endphp

<x-team.layout.app title="User Details" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        User Details
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        View user information and permissions
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('team.settings.users.toggle-status', $user) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="kt-btn {{ $user->is_active ? 'kt-btn-warning' : 'kt-btn-success' }}">
                                <i class="ki-filled {{ $user->is_active ? 'ki-toggle-off' : 'ki-toggle-on' }}"></i>
                                {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('team.settings.users.edit', $user) }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-pencil"></i>
                        Edit User
                    </a>
                    <a href="{{ route('team.settings.users.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-left"></i>
                        Back to Users
                    </a>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-5">
                <!-- User Information Card -->
                <div class="lg:col-span-2">
                    <div class="kt-card">
                        <div class="kt-card-header">
                            <h3 class="kt-card-title">User Information</h3>
                        </div>
                        <div class="kt-card-content">
                            <div class="grid md:grid-cols-2 gap-5">
                                <!-- Personal Information -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-secondary-foreground">Full Name</label>
                                        <p class="text-base font-medium">{{ $user->name }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-secondary-foreground">Email</label>
                                        <p class="text-base">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-secondary-foreground">Phone</label>
                                        <p class="text-base">{{ $user->phone ?: 'Not provided' }}</p>
                                    </div>
                                </div>

                                <!-- Work Information -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-secondary-foreground">Role & Type</label>
                                        <p class="text-base">
                                            @if($user->roles->isNotEmpty())
                                                <span class="kt-badge kt-badge-outline kt-badge-{{ $user->roles->first()->name === 'Super Admin' ? 'danger' : ($user->roles->first()->name === 'Admin' ? 'warning' : ($user->roles->first()->name === 'Manager' ? 'info' : 'secondary')) }}">
                                                    {{ $user->roles->first()->name }}
                                                </span>
                                            @else
                                                <span class="text-secondary-foreground">No role assigned</span>
                                            @endif
                                        </p>
                                        @if($user->user_type)
                                            <p class="text-sm text-secondary-foreground">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</p>
                                        @endif
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-secondary-foreground">Branch</label>
                                        <p class="text-base">{{ $user->branch->branch_name ?? 'Not assigned' }}</p>
                                        @if($user->branch)
                                            <p class="text-sm text-secondary-foreground">{{ $user->branch->branch_code }}</p>
                                        @endif
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-secondary-foreground">Role</label>
                                        <p class="text-base">
                                            @if($user->roles->isNotEmpty())
                                                <span class="kt-badge kt-badge-outline kt-badge-primary">
                                                    {{ $user->roles->first()->name }}
                                                </span>
                                            @else
                                                <span class="text-secondary-foreground">No role assigned</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Card -->
                    @if($user->roles->isNotEmpty() && $user->roles->first()->permissions->isNotEmpty())
                    <div class="kt-card mt-5">
                        <div class="kt-card-header">
                            <h3 class="kt-card-title">Permissions</h3>
                        </div>
                        <div class="kt-card-content">
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2">
                                @foreach($user->roles->first()->permissions as $permission)
                                    <div class="flex items-center gap-2 p-2 bg-light rounded">
                                        <i class="ki-filled ki-check-circle text-success text-sm"></i>
                                        <span class="text-sm">{{ $permission->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Quick Stats & Actions -->
                <div class="space-y-5">
                    <!-- Status Card -->
                    <div class="kt-card">
                        <div class="kt-card-header">
                            <h3 class="kt-card-title">Status</h3>
                        </div>
                        <div class="kt-card-content">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium">Account Status</span>
                                    <span class="kt-badge {{ $user->is_active ? 'kt-badge-success' : 'kt-badge-danger' }}">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium">Email Verified</span>
                                    <span class="kt-badge {{ $user->email_verified_at ? 'kt-badge-success' : 'kt-badge-warning' }}">
                                        {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-secondary-foreground">Member Since</span>
                                    <p class="text-sm">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-secondary-foreground">Last Updated</span>
                                    <p class="text-sm">{{ $user->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="kt-card">
                        <div class="kt-card-header">
                            <h3 class="kt-card-title">Quick Actions</h3>
                        </div>
                        <div class="kt-card-content">
                            <div class="space-y-2">
                                <a href="{{ route('team.settings.users.edit', $user) }}" class="kt-btn kt-btn-secondary kt-btn-sm w-full">
                                    <i class="ki-filled ki-pencil"></i>
                                    Edit User
                                </a>
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('team.settings.users.toggle-status', $user) }}" class="w-full">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="kt-btn {{ $user->is_active ? 'kt-btn-warning' : 'kt-btn-success' }} kt-btn-sm w-full">
                                            <i class="ki-filled {{ $user->is_active ? 'ki-toggle-off' : 'ki-toggle-on' }}"></i>
                                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                @endif
                                @can('delete', $user)
                                    <button onclick="confirmDelete()" class="kt-btn kt-btn-danger kt-btn-sm w-full">
                                        <i class="ki-filled ki-trash"></i>
                                        Delete User
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @can('delete', $user)
    @push('scripts')
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("team.settings.users.destroy", $user) }}';
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    @endpush
    @endcan
</x-team.layout.app>
