<x-team.layout.app title="Edit Company Settings">
    <x-slot name="content">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('team.company.index') }}" 
               class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Company Settings</h1>
        </div>
        <p class="text-gray-600 dark:text-gray-400">Update your company information and system configuration</p>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('team.company.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Company Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Company Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Logo Upload -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company Logo</label>
                        <div class="flex items-center space-x-4">
                            @if($company->company_logo)
                                <img src="{{ Storage::url($company->company_logo) }}" 
                                     alt="{{ $company->company_name }}" 
                                     class="h-16 w-auto object-contain bg-gray-50 dark:bg-gray-700 rounded-lg p-2"
                                     id="current-logo">
                            @else
                                <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center" id="no-logo">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <input type="file" id="logo-upload" accept="image/*" class="hidden">
                                <button type="button" onclick="document.getElementById('logo-upload').click()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    Upload Logo
                                </button>
                                @if($company->company_logo)
                                    <button type="button" id="remove-logo"
                                            class="ml-2 inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                        Remove
                                    </button>
                                @endif
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="company_name" name="company_name" 
                               value="{{ old('company_name', $company->company_name) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               required>
                    </div>

                    <!-- Company Email -->
                    <div>
                        <label for="company_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Company Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="company_email" name="company_email" 
                               value="{{ old('company_email', $company->company_email) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               required>
                    </div>

                    <!-- Company Phone -->
                    <div>
                        <label for="company_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Phone Number
                        </label>
                        <input type="text" id="company_phone" name="company_phone" 
                               value="{{ old('company_phone', $company->company_phone) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Company Website -->
                    <div>
                        <label for="company_website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Website
                        </label>
                        <input type="url" id="company_website" name="company_website" 
                               value="{{ old('company_website', $company->company_website) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               placeholder="https://example.com">
                    </div>

                    <!-- Company Address -->
                    <div class="md:col-span-2">
                        <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Address
                        </label>
                        <textarea id="company_address" name="company_address" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('company_address', $company->company_address) }}</textarea>
                    </div>

                    <!-- Company Description -->
                    <div class="md:col-span-2">
                        <label for="company_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea id="company_description" name="company_description" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('company_description', $company->company_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Configuration -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">System Configuration</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Timezone -->
                    <div>
                        <label for="timezone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Timezone <span class="text-red-500">*</span>
                        </label>
                        <select id="timezone" name="timezone" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="UTC" {{ old('timezone', $company->timezone) == 'UTC' ? 'selected' : '' }}>UTC</option>
                            <option value="America/New_York" {{ old('timezone', $company->timezone) == 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                            <option value="America/Chicago" {{ old('timezone', $company->timezone) == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                            <option value="America/Denver" {{ old('timezone', $company->timezone) == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                            <option value="America/Los_Angeles" {{ old('timezone', $company->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                            <option value="Europe/London" {{ old('timezone', $company->timezone) == 'Europe/London' ? 'selected' : '' }}>London</option>
                            <option value="Asia/Tokyo" {{ old('timezone', $company->timezone) == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
                        </select>
                    </div>

                    <!-- Date Format -->
                    <div>
                        <label for="date_format" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Date Format <span class="text-red-500">*</span>
                        </label>
                        <select id="date_format" name="date_format" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="Y-m-d" {{ old('date_format', $company->date_format) == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                            <option value="m/d/Y" {{ old('date_format', $company->date_format) == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                            <option value="d/m/Y" {{ old('date_format', $company->date_format) == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
                            <option value="M j, Y" {{ old('date_format', $company->date_format) == 'M j, Y' ? 'selected' : '' }}>Mon DD, YYYY</option>
                        </select>
                    </div>

                    <!-- Time Format -->
                    <div>
                        <label for="time_format" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Time Format <span class="text-red-500">*</span>
                        </label>
                        <select id="time_format" name="time_format" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="H:i:s" {{ old('time_format', $company->time_format) == 'H:i:s' ? 'selected' : '' }}>24 Hour (HH:MM:SS)</option>
                            <option value="g:i A" {{ old('time_format', $company->time_format) == 'g:i A' ? 'selected' : '' }}>12 Hour (H:MM AM/PM)</option>
                        </select>
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Currency <span class="text-red-500">*</span>
                        </label>
                        <select id="currency" name="currency" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="USD" {{ old('currency', $company->currency) == 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ old('currency', $company->currency) == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ old('currency', $company->currency) == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            <option value="JPY" {{ old('currency', $company->currency) == 'JPY' ? 'selected' : '' }}>JPY (¥)</option>
                            <option value="CAD" {{ old('currency', $company->currency) == 'CAD' ? 'selected' : '' }}>CAD (C$)</option>
                        </select>
                    </div>

                    <!-- Language -->
                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Language <span class="text-red-500">*</span>
                        </label>
                        <select id="language" name="language" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="en" {{ old('language', $company->language) == 'en' ? 'selected' : '' }}>English</option>
                            <option value="es" {{ old('language', $company->language) == 'es' ? 'selected' : '' }}>Spanish</option>
                            <option value="fr" {{ old('language', $company->language) == 'fr' ? 'selected' : '' }}>French</option>
                            <option value="de" {{ old('language', $company->language) == 'de' ? 'selected' : '' }}>German</option>
                            <option value="ja" {{ old('language', $company->language) == 'ja' ? 'selected' : '' }}>Japanese</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('team.company.index') }}" 
               class="inline-flex items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 text-sm font-medium rounded-md transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Changes
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Logo upload functionality
    const logoUpload = document.getElementById('logo-upload');
    const removeLogoBtn = document.getElementById('remove-logo');
    
    if (logoUpload) {
        logoUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('logo', file);
                formData.append('_token', '{{ csrf_token() }}');
                
                fetch('{{ route("team.company.logo.upload") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error uploading logo');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading logo');
                });
            }
        });
    }
    
    if (removeLogoBtn) {
        removeLogoBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove the logo?')) {
                fetch('{{ route("team.company.logo.remove") }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error removing logo');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing logo');
                });
            }        });
    }
});
</script>
    </x-slot>
</x-team.layout.app>
