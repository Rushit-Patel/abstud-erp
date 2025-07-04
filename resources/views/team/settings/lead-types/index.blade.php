@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Lead Type Management']
];
@endphp

@push('styles')
    @vite([
        'resources/css/team/vendors/dataTables.css',
    ])
@endpush

<x-team.layout.app title="Lead Type Management" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Lead Type Management
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage lead types and their status configurations
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.lead-types.create') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add Lead Type
                    </a>
                </div>
            </div>

            <x-team.card title="Lead Types List" headerClass="">
                <div class="grid lg:grid-cols-1 gap-y-5 lg:gap-7.5 items-stretch pb-5">
                    <div class="lg:col-span-1">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </x-team.card>
        </div>
    </x-slot>

    @push('scripts')
        {{-- @vite(['resources/js/team/vendors/dataTables.js']) --}}
        @vite([
            'resources/js/team/vendors/dataTables.min.js',
            'resources/js/team/vendors/buttons.dataTables.js',
            'resources/js/team/vendors/dataTables.buttons.js'
        ])
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-team.layout.app>
<x-team.modals.delete-modal
    id="delete_modal"
    title="Delete Lead Type"
    formId="deleteCountryForm"
    message="Are you sure you want to delete this lead-type? This action cannot be undone."
/>
