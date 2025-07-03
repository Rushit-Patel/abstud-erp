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
    <textarea class="kt-textarea" id="{{ $name }}" placeholder="{{ $placeholder }}" rows="4">{{ old($name, $value) }}</textarea>
    @error($name)
    <span class="text-destructive text-sm mt-1">
        {{ $message = $errors->first($name) }}
    </span>
    @enderror
</div>
