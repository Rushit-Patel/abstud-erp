@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'City Management']
];
@endphp
@push('styles')
    @vite([
        'resources/css/team/vendors/dataTables.css',
    ])
@endpush

<x-team.layout.app title="City Management" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        City Management
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Manage cities by state and country
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.cities.create') }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-plus"></i>
                        Add City
                    </a>
                </div>
            </div>
            <x-team.card title="City List" headerClass="">
                <div class="grid lg:grid-cols-1 gap-y-5 lg:gap-7.5 items-stretch  pb-5">
                    <div class="lg:col-span-1">
                        {{ $dataTable->table() }}
                    </div>

                </div>
            </x-team.card>
        </div>

        <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center backdrop-blur-sm bg-opacity-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg border border-gray-300">
                <h2 class="text-lg font-semibold mb-4">Delete City</h2>
                <p class="mb-6">Are you sure you want to delete this city?</p>

                <form id="deleteForm" action="{{ route('team.settings.cities.destroy', '__id__') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                    </div>
                </form>
            </div>
        </div>

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
</x-team.layout.app>
<x-team.modals.delete-modal
    id="delete_modal"
    title="Delete City"
    formId="deleteCountryForm"
    message="Are you sure you want to delete this city? This action cannot be undone."
/>
