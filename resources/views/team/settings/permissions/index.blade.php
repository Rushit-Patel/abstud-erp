@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Permission Management']
];
@endphp

<x-team.layout.app title="Permission Management" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Permission Management
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage system permissions and access controls
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.roles.index', ['guard' => $guard]) }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-shield"></i>
                        Manage Roles
                    </a>
                    <a href="{{ route('team.settings.permissions.create', ['guard' => $guard]) }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add Permission
                    </a>
                </div>
            </div>

            <!-- Guard Tabs -->
            <div class="kt-card mb-5">
                <div class="kt-card-content p-4">
                    <div class="flex gap-2">
                        @foreach($guards as $guardKey => $guardName)
                            <a href="{{ route('team.settings.permissions.index', ['guard' => $guardKey]) }}" 
                               class="kt-btn {{ $guard === $guardKey ? 'kt-btn-primary' : 'kt-btn-secondary' }}">
                                {{ $guardName }}
                                @if($guardKey === 'web')
                                    <i class="ki-filled ki-shield-check"></i>
                                @elseif($guardKey === 'student')
                                    <i class="ki-filled ki-user"></i>
                                @elseif($guardKey === 'partner')
                                    <i class="ki-filled ki-handshake"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="kt-card mb-5">
                <div class="kt-card-content">
                    <form method="GET" class="flex flex-wrap items-center gap-4">
                        <div class="flex-1 min-w-64">
                            <x-team.forms.input 
                                name="search" 
                                placeholder="Search permissions..." 
                                :value="request('search')" 
                                label="" />
                        </div>
                        <div class="min-w-48">
                            <x-team.forms.select
                                name="category"
                                label=""
                                :options="$categories"
                                :selected="request('category')"
                                placeholder="All Categories" />
                        </div>
                        <div class="flex gap-2">
                            <x-team.forms.button type="submit">
                                <i class="ki-filled ki-magnifier"></i>
                                Search
                            </x-team.forms.button>
                            @if(request()->hasAny(['search', 'category']))
                                <a href="{{ route('team.settings.permissions.index', ['guard' => $guard]) }}" class="kt-btn kt-btn-secondary">
                                    <i class="ki-filled ki-cross"></i>
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Permissions Table -->
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Permissions ({{ $permissions->total() }})</h3>
                </div>
                <div class="kt-card-content p-0">
                    @if($permissions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="kt-table">
                                <thead>
                                    <tr>
                                        <th class="kt-table-th">Permission Name</th>
                                        <th class="kt-table-th text-center">Category</th>
                                        <th class="kt-table-th text-center">Roles</th>
                                        <th class="kt-table-th text-center">Users</th>
                                        <th class="kt-table-th text-center">Created</th>
                                        <th class="kt-table-th text-center w-24">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                        @php
                                            $category = 'general';
                                            $name = $permission->name;
                                            if (str_contains($name, 'users')) $category = 'users';
                                            elseif (str_contains($name, 'roles') || str_contains($name, 'permissions')) $category = 'roles';
                                            elseif (str_contains($name, 'company')) $category = 'company';
                                            elseif (str_contains($name, 'branches')) $category = 'branches';
                                            elseif (str_contains($name, 'students')) $category = 'students';
                                            elseif (str_contains($name, 'partners')) $category = 'partners';
                                            elseif (str_contains($name, 'reports')) $category = 'reports';
                                            elseif (str_contains($name, 'announcements') || str_contains($name, 'notifications')) $category = 'communications';
                                            elseif (str_contains($name, 'backup') || str_contains($name, 'restore') || str_contains($name, 'system') || str_contains($name, 'audit') || str_contains($name, 'integrations')) $category = 'system';
                                            elseif (str_contains($name, 'dashboard')) $category = 'dashboard';
                                            
                                            $categoryColors = [
                                                'users' => 'kt-badge-primary',
                                                'roles' => 'kt-badge-warning',
                                                'company' => 'kt-badge-info',
                                                'branches' => 'kt-badge-success',
                                                'students' => 'kt-badge-purple',
                                                'partners' => 'kt-badge-orange',
                                                'reports' => 'kt-badge-cyan',
                                                'communications' => 'kt-badge-pink',
                                                'system' => 'kt-badge-danger',
                                                'dashboard' => 'kt-badge-secondary',
                                                'general' => 'kt-badge-secondary'
                                            ];
                                        @endphp
                                        <tr>
                                            <td class="kt-table-td">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-secondary-light text-secondary">
                                                        <i class="ki-filled ki-key text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('team.settings.permissions.show', $permission) }}" 
                                                           class="font-medium text-primary hover:text-primary-active">
                                                            {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                                        </a>
                                                        <div class="text-sm text-secondary-foreground">
                                                            {{ $permission->guard_name }} guard
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="kt-table-td text-center">
                                                <span class="kt-badge kt-badge-outline {{ $categoryColors[$category] ?? 'kt-badge-secondary' }}">
                                                    {{ ucfirst($category) }}
                                                </span>
                                            </td>
                                            <td class="kt-table-td text-center">
                                                <span class="kt-badge kt-badge-outline kt-badge-secondary">
                                                    {{ $permission->roles_count }}
                                                </span>
                                            </td>
                                            <td class="kt-table-td text-center">
                                                <span class="kt-badge kt-badge-outline kt-badge-info">
                                                    {{ $permission->users_count }}
                                                </span>
                                            </td>
                                            <td class="kt-table-td text-center text-sm text-secondary-foreground">
                                                {{ $permission->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="kt-table-td text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <a href="{{ route('team.settings.permissions.show', $permission) }}" 
                                                       class="kt-btn kt-btn-sm kt-btn-secondary kt-btn-icon"
                                                       title="View">
                                                        <i class="ki-filled ki-eye"></i>
                                                    </a>
                                                    <a href="{{ route('team.settings.permissions.edit', $permission) }}" 
                                                       class="kt-btn kt-btn-sm kt-btn-primary kt-btn-icon"
                                                       title="Edit">
                                                        <i class="ki-filled ki-pencil"></i>
                                                    </a>
                                                    @if($permission->roles_count == 0)
                                                        <button onclick="confirmDelete('{{ $permission->name }}', '{{ route('team.settings.permissions.destroy', $permission) }}')" 
                                                                class="kt-btn kt-btn-sm kt-btn-danger kt-btn-icon"
                                                                title="Delete">
                                                            <i class="ki-filled ki-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($permissions->hasPages())
                            <div class="kt-card-footer">
                                {{ $permissions->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-10">
                            <i class="ki-filled ki-key text-4xl text-muted-foreground mb-4"></i>
                            <h3 class="text-lg font-medium mb-2">No Permissions Found</h3>
                            <p class="text-secondary-foreground mb-4">
                                @if(request('search') || request('category'))
                                    No permissions match your search criteria.
                                @else
                                    Get started by creating your first permission.
                                @endif
                            </p>
                            @if(request('search') || request('category'))
                                <a href="{{ route('team.settings.permissions.index') }}" class="kt-btn kt-btn-secondary">
                                    <i class="ki-filled ki-cross"></i>
                                    Clear Search
                                </a>
                            @else
                                <a href="{{ route('team.settings.permissions.create') }}" class="kt-btn kt-btn-primary">
                                    <i class="ki-filled ki-plus"></i>
                                    Create First Permission
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
    <script>
        function confirmDelete(permissionName, deleteUrl) {
            if (confirm(`Are you sure you want to delete the permission "${permissionName}"? This action cannot be undone.`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
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
</x-team.layout.app>
