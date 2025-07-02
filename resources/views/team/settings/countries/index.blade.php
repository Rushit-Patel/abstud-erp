@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Country Management']
];
@endphp

<x-team.layout.app title="Country Management" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Country Management
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage countries, currencies, and timezone configurations
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.countries.create') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add Country
                    </a>
                </div>
            </div>

            <div class="grid lg:grid-cols-4 gap-5 mb-7.5">
                <div class="kt-card">
                    <div class="kt-card-body p-5">
                        <div class="flex items-center gap-2.5">
                            <div class="kt-symbol kt-symbol-40px">
                                <div class="kt-symbol-label kt-bg-primary kt-text-inverse">
                                    <i class="ki-filled ki-geolocation text-lg"></i>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-lg font-medium text-mono">{{ $countries->total() }}</span>
                                <span class="text-sm text-secondary-foreground">Total Countries</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="kt-card">
                    <div class="kt-card-body p-5">
                        <div class="flex items-center gap-2.5">
                            <div class="kt-symbol kt-symbol-40px">
                                <div class="kt-symbol-label kt-bg-success kt-text-inverse">
                                    <i class="ki-filled ki-check-circle text-lg"></i>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-lg font-medium text-mono">{{ $countries->where('is_active', true)->count() }}</span>
                                <span class="text-sm text-secondary-foreground">Active Countries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Countries List</h3>
                </div>
                <div class="kt-card-body p-0">
                    @if($countries->count() > 0)
                        <div class="kt-table-container">
                            <table class="kt-table kt-table-divider">
                                <thead>
                                    <tr>
                                        <th class="min-w-[150px]">Country</th>
                                        <th class="min-w-[100px]">Phone Code</th>
                                        <th class="min-w-[120px]">Currency</th>
                                        <th class="min-w-[100px]">Status</th>
                                        <th class="text-center min-w-[100px]">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($countries as $country)
                                        <tr>
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    @if($country->icon)
                                                        <div class="kt-symbol kt-symbol-35px">
                                                            <div class="kt-symbol-label">
                                                                {{ $country->icon }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="flex flex-col">
                                                        <a href="{{ route('team.settings.countries.show', $country) }}" 
                                                           class="font-medium text-mono hover:text-primary">
                                                            {{ $country->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-sm">{{ $country->formatted_phone_code }}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm">{{ $country->full_currency }}</span>
                                            </td>
                                            <td>
                                                @if($country->is_active)
                                                    <span class="kt-badge kt-badge-success kt-badge-sm">Active</span>
                                                @else
                                                    <span class="kt-badge kt-badge-secondary kt-badge-sm">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="kt-dropdown" data-kt-dropdown="true" data-kt-dropdown-attach="parent" data-kt-dropdown-trigger="click">
                                                    <button class="kt-btn kt-btn-icon kt-btn-sm kt-btn-ghost kt-btn-primary" data-kt-dropdown-toggle="dropdown">
                                                        <i class="ki-filled ki-dots-vertical"></i>
                                                    </button>
                                                    <div class="kt-dropdown-content min-w-[175px]">
                                                        <div class="kt-dropdown-item">
                                                            <a href="{{ route('team.settings.countries.show', $country) }}" class="kt-dropdown-link">
                                                                <i class="ki-filled ki-eye me-2"></i>
                                                                View Details
                                                            </a>
                                                        </div>
                                                        <div class="kt-dropdown-item">
                                                            <a href="{{ route('team.settings.countries.edit', $country) }}" class="kt-dropdown-link">
                                                                <i class="ki-filled ki-notepad-edit me-2"></i>
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <div class="kt-dropdown-item">
                                                            <form action="{{ route('team.settings.countries.toggle-status', $country) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="kt-dropdown-link w-full text-left">
                                                                    @if($country->is_active)
                                                                        <i class="ki-filled ki-minus-circle me-2"></i>
                                                                        Deactivate
                                                                    @else
                                                                        <i class="ki-filled ki-check-circle me-2"></i>
                                                                        Activate
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="kt-dropdown-separator"></div>
                                                        <div class="kt-dropdown-item">
                                                            <form action="{{ route('team.settings.countries.destroy', $country) }}" method="POST" 
                                                                  onsubmit="return confirm('Are you sure you want to delete this country?')" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="kt-dropdown-link w-full text-left text-danger">
                                                                    <i class="ki-filled ki-trash me-2"></i>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        @if($countries->hasPages())
                            <div class="kt-card-footer">
                                {{ $countries->links() }}
                            </div>
                        @endif
                    @else
                        <div class="kt-empty-state">
                            <div class="kt-empty-state-icon">
                                <i class="ki-filled ki-geolocation text-5xl text-muted"></i>
                            </div>
                            <div class="kt-empty-state-body">
                                <h3 class="kt-empty-state-title">No Countries Found</h3>
                                <div class="kt-empty-state-text">
                                    Start by adding your first country to manage locations.
                                </div>
                            </div>
                            <div class="kt-empty-state-actions">
                                <a href="{{ route('team.settings.countries.create') }}" class="kt-btn kt-btn-primary">
                                    <i class="ki-filled ki-plus"></i>
                                    Add Country
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-team.layout.app>
