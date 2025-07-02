{{-- Team Input Field Component --}}
@props([
    'label',
    'name',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'icon' => null
])
<div class="flex flex-col gap-1.5">
    <label for="{{ $name }}" class="kt-form-label text-mono">
        {{ $label }}
        @if($required)
            <span class="text-destructive">*</span>
        @endif
    </label>
    <input class="kt-input" id="{{ $name }}" 
        name="{{ $name }}" 
        type="{{ $type }}" 
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"/>
    @error($name)
    <span class="text-destructive text-sm mt-1">
        {{ $message = $errors->first($name) }}
    </span>
    @enderror
</div>
