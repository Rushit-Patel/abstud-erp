@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Role Management', 'url' => route('team.settings.roles.index')],
    ['title' => 'Add Role']
];
@endphp

<x-team.layout.app title="Add Role" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Add New Role
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Create a new role with permissions
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.roles.index', ['guard' => $guard]) }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-left"></i>
                        Back to Roles
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('team.settings.roles.store') }}" class="kt-card">
                @csrf
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Role Information</h3>
                </div>
                <div class="kt-card-content">
                    <div class="grid gap-5">
                        <!-- Guard Selection -->
                        <div class="lg:w-1/2">
                            <x-team.forms.select
                                name="guard_name"
                                label="Guard Type"
                                required
                                :options="$guards"
                                :selected="old('guard_name', $guard)"
                                placeholder="Select guard type" />
                            <div class="text-sm text-secondary-foreground mt-1">
                                Choose the user type this role applies to
                            </div>
                        </div>
                        
                        <!-- Role Name -->
                        <div class="lg:w-1/2">
                            <x-team.forms.input 
                                name="name" 
                                label="Role Name" 
                                type="text" 
                                :required="true"
                                placeholder="Enter role name (e.g., Content Manager)" 
                                :value="old('name')" />
                        </div>

                        <!-- Permissions -->
                        <div>
                            <label class="kt-form-label required">Permissions</label>
                            <div class="mt-2">
                                @foreach($permissions as $category => $categoryPermissions)
                                    <div class="kt-card mb-4">
                                        <div class="kt-card-header py-3">
                                            <h4 class="kt-card-title text-sm">
                                                {{ ucfirst(str_replace('_', ' ', $category)) }} Permissions
                                            </h4>
                                            <div class="flex gap-2">
                                                <button type="button" onclick="selectAllInCategory('{{ $category }}')" 
                                                        class="kt-btn kt-btn-xs kt-btn-secondary">
                                                    Select All
                                                </button>
                                                <button type="button" onclick="deselectAllInCategory('{{ $category }}')" 
                                                        class="kt-btn kt-btn-xs kt-btn-secondary">
                                                    Deselect All
                                                </button>
                                            </div>
                                        </div>
                                        <div class="kt-card-content">
                                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
                                                @foreach($categoryPermissions as $permission)
                                                    <div class="flex items-center gap-2">
                                                        <input type="checkbox" 
                                                               id="permission_{{ $permission->id }}" 
                                                               name="permissions[]" 
                                                               value="{{ $permission->id }}"
                                                               class="kt-checkbox permission-checkbox permission-{{ $category }}"
                                                               {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                                        <label for="permission_{{ $permission->id }}" class="text-sm">
                                                            {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <div class="kt-form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="kt-card-footer">
                    <div class="flex justify-end gap-2.5">
                        <a href="{{ route('team.settings.roles.index') }}" class="kt-btn kt-btn-secondary">
                            Cancel
                        </a>
                        <x-team.forms.button type="submit">
                            <i class="ki-filled ki-check"></i>
                            Create Role
                        </x-team.forms.button>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>

    @push('scripts')
    <script>
        function selectAllInCategory(category) {
            const checkboxes = document.querySelectorAll('.permission-' + category);
            checkboxes.forEach(checkbox => checkbox.checked = true);
        }

        function deselectAllInCategory(category) {
            const checkboxes = document.querySelectorAll('.permission-' + category);
            checkboxes.forEach(checkbox => checkbox.checked = false);
        }

        // Master select all
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllBtn = document.getElementById('select-all-permissions');
            if (selectAllBtn) {
                selectAllBtn.addEventListener('click', function() {
                    const checkboxes = document.querySelectorAll('.permission-checkbox');
                    checkboxes.forEach(checkbox => checkbox.checked = true);
                });
            }
        });
    </script>
    @endpush
</x-team.layout.app>
