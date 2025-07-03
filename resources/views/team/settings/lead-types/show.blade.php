@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Lead Types', 'url' => route('team.settings.lead-types.index')],
    ['title' => 'View Lead Type']
];
@endphp

<x-team.layout.app title="View Lead Type" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Lead Type Details: {{ $leadType->name }}
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        View lead type information
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.lead-types.edit', $leadType) }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-pencil"></i>
                        Edit Lead Type
                    </a>
                    <a href="{{ route('team.settings.lead-types.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7.5">
                <!-- Main Information -->
                <div class="lg:col-span-2">
                    <x-team.card title="Lead Type Information" headerClass="">
                        <div class="py-5">
                            <div class="grid grid-cols-1 gap-5">
                                <!-- Name -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-2xs text-gray-600 font-medium uppercase">Name</label>
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $leadType->name }}
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-2xs text-gray-600 font-medium uppercase">Status</label>
                                    <div>
                                        @if($leadType->status)
                                            <span class="badge badge-light-success">Active</span>
                                        @else
                                            <span class="badge badge-light-danger">Inactive</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Created At -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-2xs text-gray-600 font-medium uppercase">Created At</label>
                                    <div class="text-sm text-gray-900">
                                        {{ $leadType->created_at->format('M d, Y \a\t h:i A') }}
                                    </div>
                                </div>

                                <!-- Updated At -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-2xs text-gray-600 font-medium uppercase">Last Updated</label>
                                    <div class="text-sm text-gray-900">
                                        {{ $leadType->updated_at->format('M d, Y \a\t h:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-team.card>
                </div>

                <!-- Actions Panel -->
                <div class="lg:col-span-1">
                    <x-team.card title="Actions" headerClass="">
                        <div class="py-5">
                            <div class="flex flex-col gap-3">
                                <!-- Edit -->
                                <a href="{{ route('team.settings.lead-types.edit', $leadType) }}" 
                                   class="kt-btn kt-btn-primary kt-btn-sm">
                                    <i class="ki-filled ki-pencil"></i>
                                    Edit Lead Type
                                </a>

                                <!-- Toggle Status -->
                                <button type="button" 
                                        class="kt-btn kt-btn-{{ $leadType->status ? 'warning' : 'success' }} kt-btn-sm toggle-status-btn"
                                        data-url="{{ route('team.settings.lead-types.toggle-status', $leadType) }}">
                                    <i class="ki-filled ki-{{ $leadType->status ? 'cross' : 'check' }}"></i>
                                    {{ $leadType->status ? 'Deactivate' : 'Activate' }}
                                </button>

                                <!-- Delete -->
                                <button type="button" 
                                        class="kt-btn kt-btn-danger kt-btn-sm delete-btn"
                                        data-url="{{ route('team.settings.lead-types.destroy', $leadType) }}">
                                    <i class="ki-filled ki-trash"></i>
                                    Delete Lead Type
                                </button>

                                <!-- Back to List -->
                                <a href="{{ route('team.settings.lead-types.index') }}" 
                                   class="kt-btn kt-btn-secondary kt-btn-sm">
                                    <i class="ki-filled ki-arrow-left"></i>
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </x-team.card>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden backdrop-blur-sm bg-opacity-50" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg border border-gray-300">
                    <h2 class="text-lg font-semibold mb-4">Delete Lead Type</h2>
                    <p class="mb-6">Are you sure you want to delete the lead type "{{ $leadType->name }}"? This action cannot be undone.</p>
                    
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
        </div>
    </x-slot>

    @push('scripts')
        <script>
            let deleteUrl = '';
            
            // Handle delete button click
            $('.delete-btn').on('click', function() {
                deleteUrl = $(this).data('url');
                $('#deleteModal').removeClass('hidden').show();
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
                                window.location.href = '{{ route("team.settings.lead-types.index") }}';
                            } else {
                                showNotification('error', response.message);
                            }
                        },
                        error: function() {
                            showNotification('error', 'An error occurred while deleting the lead type.');
                        }
                    });
                }
            });
            
            // Handle status toggle
            $('.toggle-status-btn').on('click', function() {
                const url = $(this).data('url');
                
                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
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
                $('#deleteModal').addClass('hidden').hide();
                deleteUrl = '';
            }
            
            function showNotification(type, message) {
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
