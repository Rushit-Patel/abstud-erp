{{-- Team Checkbox Component --}}
@props([
    'name',
    'label',
    'checked' => false,
    'value' => '1'
])
<label class="kt-label">
    <input class="kt-checkbox kt-checkbox-sm" id="{{ $name }}" 
        name="{{ $name }}" 
        type="checkbox" 
        value="{{ $value }}" @if($checked || old($name)) checked @endif
    />
    <span class="kt-checkbox-label">
        {{ $label }}
    </span>
</label>