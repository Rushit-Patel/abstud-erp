@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Branch Management']
];
@endphp

<x-team.layout.app title="Branch Management" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Branch Management
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage branch locations and configurations
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.branches.create') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add Branch
                    </a>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Branches</h3>
                </div>
                <div class="kt-card-content">
                    @if($branches->isEmpty())
                        <div class="text-center py-10">
                            <i class="ki-filled ki-geolocation text-4xl text-muted-foreground mb-4"></i>
                            <h3 class="text-lg font-medium mb-2">No Branches Found</h3>
                            <p class="text-secondary-foreground mb-4">Start by adding your first branch location.</p>
                            <a href="{{ route('team.settings.branches.create') }}" class="kt-btn kt-btn-primary">
                                <i class="ki-filled ki-plus"></i>
                                Add First Branch
                            </a>
                        </div>
                    @else
                        <div class="kt-table-wrapper">
                            <table class="kt-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($branches as $branch)
                                        <tr>
                                            <td>{{ $branch->name }}</td>
                                            <td>{{ $branch->address ?: 'Not set' }}</td>
                                            <td>{{ $branch->phone ?: 'Not set' }}</td>
                                            <td>{{ $branch->email ?: 'Not set' }}</td>
                                            <td>
                                                @if($branch->is_active)
                                                    <span class="kt-badge kt-badge-success">Active</span>
                                                @else
                                                    <span class="kt-badge kt-badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex gap-2">
                                                    <a href="{{ route('team.settings.branches.edit', $branch) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                                        <i class="ki-filled ki-notepad-edit"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('team.settings.branches.destroy', $branch) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this branch?')">
                                                            <i class="ki-filled ki-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if($branches->hasPages())
                            <div class="mt-4">
                                {{ $branches->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-team.layout.app>
