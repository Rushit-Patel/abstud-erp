@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Country Management']
];
@endphp
@push('styles')
    @vite([
        'resources/css/team/vendors/dataTables.css',
    ])
@endpush
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

            {{-- <div class="grid lg:grid-cols-4 gap-5 mb-7.5">
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
            </div> --}}

         <x-team.card title="Countries List" headerClass="">
                    <div class="grid lg:grid-cols-1 gap-y-5 lg:gap-7.5 items-stretch  pb-5">
                        <div class="lg:col-span-1">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </x-team.card>

        </div>
    </x-slot>
        @push('scripts')
        @vite([
            'resources/js/team/vendors/dataTables.min.js',
            'resources/js/team/vendors/buttons.dataTables.js',
            'resources/js/team/vendors/dataTables.buttons.js'
        ])
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this country?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

</x-team.layout.app>
