@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Foreign Country', 'url' => route('team.settings.foreign-country.index')],
    ['title' => 'Create Foreign Country']
];
@endphp

<x-team.layout.app title="Create Foreign Country" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Create New Foreign Country
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Add a new foreign-country to the system
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.foreign-country.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>

            <x-team.card title="Foreign Country Information" headerClass="">
                <form action="{{ route('team.settings.foreign-country.store') }}" method="POST" class="form">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 py-5">
                        <div class="flex flex-col gap-2.5">
                            <label for="name" class="form-label required">Country Name</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Enter foreign-country name"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col gap-2.5">
                            <label class="form-label">Status</label>
                            <div class="form-check">
                                <input type="checkbox" 
                                       id="status" 
                                       name="status" 
                                       class="form-check-input" 
                                       value="1"
                                       {{ old('status', true) ? 'checked' : '' }}>
                                <label for="status" class="form-check-label">
                                    Active
                                </label>
                            </div>
                            <div class="text-2xs text-gray-600">
                                Uncheck to make this foreign-country inactive
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-2.5 pt-5 border-t border-gray-200">
                        <a href="{{ route('team.settings.foreign-country.index') }}" class="kt-btn kt-btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="kt-btn kt-btn-primary">
                            <i class="ki-filled ki-check"></i>
                            Create Foreign Country
                        </button>
                    </div>
                </form>
            </x-team.card>
        </div>
    </x-slot>

    @push('scripts')
        <script>
            // Form validation and enhancement
            $(document).ready(function() {
                // Add any additional form enhancements here
                
                // Focus on name field
                $('#name').focus();
                
                // Form submission handling
                $('form').on('submit', function() {
                    // Disable submit button to prevent double submission
                    $(this).find('button[type="submit"]').prop('disabled', true);
                });
            });
        </script>
    @endpush
</x-team.layout.app>
