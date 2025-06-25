@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Settings', 'url' => route('team.settings.index')],
    ['title' => 'Company Settings', 'url' => route('team.settings.company.index')],
    ['title' => 'Edit Company Settings']
];
@endphp
<x-team.layout.app title="Edit Company Settings" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <!-- Page Header -->
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Edit Company Settings
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Update your company information and system settings
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('team.settings.company.index') }}" class="kt-btn kt-btn-secondary">
                        <i class="ki-filled ki-black-left"></i>
                        Back to Settings
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="kt-alert kt-alert-success mb-5">
                    <div class="kt-alert-content">
                        <div class="kt-alert-title">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="kt-alert kt-alert-destructive mb-5">
                    <div class="kt-alert-content">
                        <div class="kt-alert-title">
                            Please fix the following errors:
                        </div>
                        <ul class="list-disc list-inside mt-2 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Company Settings Form -->
            <form action="{{ route('team.settings.company.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">
                    <!-- Company Information -->
                    <div class="col-span-1">
                        <x-team.card title="Company Information">
                            <div class="grid gap-5">
                                <!-- Company Name -->
                                <x-team.forms.input
                                    name="company_name"
                                    label="Company Name"
                                    type="text"
                                    :required="true"
                                    placeholder="Enter company name"
                                    :value="$company->company_name ?? ''"
                                />

                                <!-- Email -->
                                <x-team.forms.input
                                    name="email"
                                    label="Company Email"
                                    type="email"
                                    placeholder="Enter company email address"
                                    :value="$company->email ?? ''"
                                />

                                <!-- Phone -->
                                <x-team.forms.input
                                    name="phone"
                                    label="Phone Number"
                                    type="tel"
                                    placeholder="Enter phone number"
                                    :value="$company->phone ?? ''"
                                />

                                <!-- Website URL -->
                                <x-team.forms.input
                                    name="website_url"
                                    label="Website URL"
                                    type="url"
                                    placeholder="https://example.com"
                                    :value="$company->website_url ?? ''"
                                />

                                <!-- Company Address -->
                                <div class="flex flex-col gap-1">
                                    <label for="company_address" class="kt-form-label font-normal text-mono">
                                        Company Address
                                    </label>
                                    <textarea 
                                        class="kt-input min-h-24" 
                                        id="company_address" 
                                        name="company_address" 
                                        placeholder="Enter complete company address"
                                        rows="3">{{ old('company_address', $company->company_address ?? '') }}</textarea>
                                    @error('company_address')
                                    <span class="text-destructive text-sm mt-1">
                                        {{ $errors->first('company_address') }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </x-team.card>
                    </div>
                    <!-- Location & Assets -->
                    <div class="col-span-1">
                        <div class="grid gap-5 lg:gap-7.5">
                            <!-- Location Information -->
                            <x-team.card title="Location Details">
                                <div class="grid gap-5">
                                    <!-- City -->
                                    <x-team.forms.input
                                        name="city"
                                        label="City"
                                        type="text"
                                        placeholder="Enter city"
                                        :value="$company->city ?? ''"
                                    />

                                    <!-- State -->
                                    <x-team.forms.input
                                        name="state"
                                        label="State/Province"
                                        type="text"
                                        placeholder="Enter state or province"
                                        :value="$company->state ?? ''"
                                    />

                                    <!-- Country -->
                                    <x-team.forms.input
                                        name="country"
                                        label="Country"
                                        type="text"
                                        placeholder="Enter country"
                                        :value="$company->country ?? ''"
                                    />

                                    <!-- Postal Code -->
                                    <x-team.forms.input
                                        name="postal_code"
                                        label="Postal Code"
                                        type="text"
                                        placeholder="Enter postal/zip code"
                                        :value="$company->postal_code ?? ''"
                                    />
                                </div>
                            </x-team.card>

                            <!-- Company Assets -->
                            <x-team.card title="Company Assets">
                                <div class="grid gap-5">
                                    <!-- Company Logo -->
                                    <div class="flex flex-col gap-1">
                                        <label for="company_logo" class="kt-form-label font-normal text-mono">
                                            Company Logo
                                        </label>
                                        <div class="flex items-center gap-4">
                                            @if($company && $company->company_logo)
                                                <div class="size-16 rounded-lg overflow-hidden border border-input">
                                                    <img src="{{ Storage::url($company->company_logo) }}" 
                                                            alt="{{ $company->company_name }}" 
                                                            class="w-full h-full object-cover">
                                                </div>
                                            @else
                                                <div class="size-16 rounded-lg border-2 border-dashed border-input flex items-center justify-center bg-background">
                                                    <i class="ki-filled ki-picture text-xl text-muted-foreground"></i>
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <input 
                                                    type="file" 
                                                    id="company_logo" 
                                                    name="company_logo" 
                                                    accept="image/*"
                                                    class="kt-input"
                                                />
                                                <p class="text-xs text-muted-foreground mt-1">
                                                    Upload company logo (PNG, JPG, GIF). Recommended size: 150x150px
                                                </p>
                                            </div>
                                        </div>
                                        @error('company_logo')
                                        <span class="text-destructive text-sm mt-1">
                                            {{ $errors->first('company_logo') }}
                                        </span>
                                        @enderror
                                    </div>

                                        <!-- Company Favicon -->
                                    <div class="flex flex-col gap-1">
                                        <label for="company_favicon" class="kt-form-label font-normal text-mono">
                                            Favicon
                                        </label>
                                        <div class="flex items-center gap-4">
                                            @if($company && $company->company_favicon)
                                                <div class="size-8 rounded overflow-hidden border border-input">
                                                    <img src="{{ Storage::url($company->company_favicon) }}" 
                                                            alt="Favicon" 
                                                            class="w-full h-full object-cover">
                                                </div>
                                            @else
                                                <div class="size-8 rounded border-2 border-dashed border-input flex items-center justify-center bg-background">
                                                    <i class="ki-filled ki-picture text-xs text-muted-foreground"></i>
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <input 
                                                    type="file" 
                                                    id="company_favicon" 
                                                    name="company_favicon" 
                                                    accept="image/*"
                                                    class="kt-input"
                                                />
                                                <p class="text-xs text-muted-foreground mt-1">
                                                    Upload favicon (ICO, PNG). Recommended size: 32x32px
                                                </p>
                                            </div>
                                        </div>
                                        @error('company_favicon')
                                        <span class="text-destructive text-sm mt-1">
                                            {{ $errors->first('company_favicon') }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </x-team.card>
                        </div>
                    </div>
                </div>

                <!-- Setup Status -->
                <x-team.card title="Setup Status" cardClass="mt-5">
                    <div class="flex items-center gap-3">
                        <x-team.forms.checkbox
                            name="is_setup_completed"
                            label="Mark company setup as completed"
                            :checked="$company && $company->is_setup_completed"
                        />
                        <div class="text-sm text-muted-foreground">
                            Check this when all required company information has been configured
                        </div>
                    </div>
                </x-team.card>

                <!-- Form Actions -->
                <div class="flex justify-end gap-2.5 mt-7.5">
                    <a href="{{ route('team.settings.company.index') }}" class="kt-btn kt-btn-secondary">
                        Cancel
                    </a>
                    <x-team.forms.button type="submit">
                        <i class="ki-filled ki-check"></i>
                        Update Company Settings
                    </x-team.forms.button>
                </div>
            </form>
        </div>
    </x-slot>
</x-team.layout.app>