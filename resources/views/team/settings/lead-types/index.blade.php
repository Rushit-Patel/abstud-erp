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

        <!-- Delete Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden backdrop-blur-sm bg-opacity-50" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg border border-gray-300">
                <h2 class="text-lg font-semibold mb-4">Delete Lead Type</h2>
                <p class="mb-6">Are you sure you want to delete this lead type? This action cannot be undone.</p>
                
                <div class="flex justify-end gap-2">
                    <button type="button" class="kt-btn kt-btn-secondary" onclick="closeDeleteModal()">
                        Cancel
                    </button>
                    <button type="button" class="kt-btn kt-btn-danger" id="confirmDeleteBtn">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
        @vite(['resources/js/team/vendors/dataTables.js'])
        {{ $dataTable->scripts() }}
        
        <script>
            let deleteUrl = '';
            
            // Handle delete button clicks
            $(document).on('click', '.delete-btn', function() {
                deleteUrl = $(this).data('url');
                $('#deleteModal').removeClass('hidden');
            });
            
            // Handle delete confirmation
            $('#confirmDeleteBtn').on('click', function() {
                if (deleteUrl) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                closeDeleteModal();
                                $('#lead-types-table').DataTable().ajax.reload();
                                showNotification('success', response.message);
                            } else {
                                showNotification('error', response.message);
                            }
                        },
                        error: function(xhr) {
                            showNotification('error', 'An error occurred while deleting the lead type.');
                        }
                    });
                }
            });
            
            // Handle status toggle
            $(document).on('click', '.toggle-status-btn', function() {
                const url = $(this).data('url');
                const button = $(this);
                
                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#lead-types-table').DataTable().ajax.reload();
                            showNotification('success', response.message);
                        } else {
                            showNotification('error', response.message);
                        }
                    },
                    error: function() {
                        showNotification('error', 'An error occurred while updating the status.');
                    }
                });
            });
            
            function closeDeleteModal() {
                $('#deleteModal').addClass('hidden');
                deleteUrl = '';
            }
            
            function showNotification(type, message) {
                // Implementation depends on your notification system
                if (type === 'success') {
                    toastr.success(message);
                } else {
                    toastr.error(message);
                }
            }
            
            // Close modal when clicking outside
            $('#deleteModal').on('click', function(e) {
                if (e.target === this) {
                    closeDeleteModal();
                }
            });
        </script>
    @endpush
</x-team.layout.app>
