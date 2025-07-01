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
                        Manage user accounts, roles, and permissions
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.users.create') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add User
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="kt-card mb-7.5">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Filters</h3>
                    <button class="kt-btn kt-btn-sm kt-btn-secondary" onclick="clearFilters()">
                        <i class="ki-filled ki-cross"></i>
                        Clear
                    </button>
                </div>
                <div class="kt-card-content">
                    <form method="GET" action="{{ route('team.settings.users.index') }}" class="grid lg:grid-cols-4 gap-5">
                        <div>
                            <label class="kt-form-label">Search</label>
                            <input type="text" name="search" class="kt-input" placeholder="Name, email, phone..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div>
                            <label class="kt-form-label">Branch</label>
                            <select name="branch_id" class="kt-select">
                                <option value="">All Branches</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="kt-form-label">Role</label>
                            <select name="role" class="kt-select">
                                <option value="">All Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="kt-form-label">Status</label>
                            <select name="status" class="kt-select">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="lg:col-span-4 flex justify-end">
                            <button type="submit" class="kt-btn kt-btn-primary">
                                <i class="ki-filled ki-magnifier"></i>
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid lg:grid-cols-4 gap-5 mb-7.5">
                <div class="kt-card">
                    <div class="kt-card-content flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-secondary-foreground">Total Users</h3>
                            <p class="text-2xl font-bold">{{ $users->total() }}</p>
                        </div>
                        <div class="kt-badge kt-badge-primary kt-badge-lg">
                            <i class="ki-filled ki-people text-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="kt-card">
                    <div class="kt-card-content flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-secondary-foreground">Active Users</h3>
                            <p class="text-2xl font-bold text-success">{{ $users->where('is_active', true)->count() }}</p>
                        </div>
                        <div class="kt-badge kt-badge-success kt-badge-lg">
                            <i class="ki-filled ki-check text-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="kt-card">
                    <div class="kt-card-content flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-secondary-foreground">Inactive Users</h3>
                            <p class="text-2xl font-bold text-danger">{{ $users->where('is_active', false)->count() }}</p>
                        </div>
                        <div class="kt-badge kt-badge-danger kt-badge-lg">
                            <i class="ki-filled ki-cross text-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="kt-card">
                    <div class="kt-card-content flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-secondary-foreground">Admin Users</h3>
                            <p class="text-2xl font-bold text-info">{{ $users->filter(fn($user) => $user->isAdmin())->count() }}</p>
                        </div>
                        <div class="kt-badge kt-badge-info kt-badge-lg">
                            <i class="ki-filled ki-crown text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Users</h3>
                </div>
                <div class="kt-card-content">
                    @if($users->isEmpty())
                        <div class="text-center py-10">
                            <i class="ki-filled ki-people text-4xl text-muted-foreground mb-4"></i>
                            <h3 class="text-lg font-medium mb-2">No Users Found</h3>
                            <p class="text-secondary-foreground mb-4">Start by adding your first user.</p>
                            <a href="{{ route('team.settings.users.create') }}" class="kt-btn kt-btn-primary">
                                <i class="ki-filled ki-plus"></i>
                                Add First User
                            </a>
                        </div>
                    @else
                        <div class="kt-table-wrapper">
                            <table class="kt-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Contact</th>
                                        <th>Branch</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="kt-avatar kt-avatar-circle kt-avatar-md">
                                                        @if($user->profile_photo)
                                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                                                        @else
                                                            <span class="kt-avatar-initials">{{ $user->initials() }}</span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-foreground">{{ $user->name }}</div>
                                                        <div class="text-sm text-secondary-foreground">{{ ucfirst($user->user_type) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="text-sm">{{ $user->email }}</div>
                                                    <div class="text-sm text-secondary-foreground">{{ $user->phone ?: 'No phone' }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($user->branch)
                                                    <div>
                                                        <div class="font-medium">{{ $user->branch->branch_name }}</div>
                                                        <div class="text-sm text-secondary-foreground">{{ $user->branch->branch_code }}</div>
                                                    </div>
                                                @else
                                                    <span class="text-muted-foreground">No branch</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="kt-badge kt-badge-outline kt-badge-primary">
                                                    {{ $user->getRoleDisplayName() }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($user->is_active)
                                                    <span class="kt-badge kt-badge-success">Active</span>
                                                @else
                                                    <span class="kt-badge kt-badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex gap-2">
                                                    <a href="{{ route('team.settings.users.show', $user) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                                        <i class="ki-filled ki-eye"></i>
                                                    </a>
                                                    <a href="{{ route('team.settings.users.edit', $user) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                                        <i class="ki-filled ki-notepad-edit"></i>
                                                    </a>
                                                    @if($user->id !== auth()->id())
                                                        <form method="POST" action="{{ route('team.settings.users.toggle-status', $user) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost {{ $user->is_active ? 'text-warning' : 'text-success' }}">
                                                                <i class="ki-filled {{ $user->is_active ? 'ki-toggle-off' : 'ki-toggle-on' }}"></i>
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{ route('team.settings.users.destroy', $user) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger">
                                                                <i class="ki-filled ki-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if($users->hasPages())
                            <div class="mt-4">
                                {{ $users->appends(request()->query())->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
    <script>
        function clearFilters() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.type === 'text' || input.type === 'search') {
                    input.value = '';
                } else if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                }
            });
            form.submit();
        }
    </script>
    @endpush
</x-team.layout.app>
