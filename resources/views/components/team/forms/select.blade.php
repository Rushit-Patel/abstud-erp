@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select an option...',
    'required' => false,
    'searchable' => false,
    'multiple' => false,
    'disabled' => false
])

<div class="flex flex-col gap-1.5">
    {{-- Label --}}
    <label class="kt-form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    <select 
        name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
        id="{{ $name }}"
        class="kt-select" 
        data-kt-select="true"
        data-kt-select-placeholder="{{ $placeholder }}"
        data-kt-select-config='{
            "optionsClass": "kt-scrollable overflow-auto max-h-[250px]"{{ $searchable ? ', "search": true' : '' }}
        }'
        {{ $required ? 'required' : '' }}
        {{ $multiple ? 'multiple' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes }}>
        
        @if(is_array($options) || $options instanceof \Illuminate\Support\Collection)
            @foreach($options as $option)
                @php
                    // Handle both objects and arrays
                    if (is_object($option)) {
                        $optionValue = $option->id ?? $option->value ?? $option;
                        $optionText = $option->name ?? $option->text ?? $option->branch_name ?? $option;
                        $optionSubtext = isset($option->branch_code) ? " ({$option->branch_code})" : '';
                    } else {
                        $optionValue = $option;
                        $optionText = $option;
                        $optionSubtext = '';
                    }
                    
                    $isSelected = is_array($selected) 
                        ? in_array($optionValue, $selected) 
                        : $selected == $optionValue;
                @endphp
                <option value="{{ $optionValue }}" {{ $isSelected ? 'selected' : '' }}>
                    {{ $optionText }}{{ $optionSubtext }}
                </option>
            @endforeach
        @endif
    </select>
    
    @error($name)
        <div class="kt-form-error">{{ $message }}</div>
    @enderror
</div>
