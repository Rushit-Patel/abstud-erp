{{-- Team Card Component --}}
@props([
    'title' => null,
    'headerClass' => '',
    'bodyClass' => '',
    'cardClass' => ''
])

<div class="kt-card {{ $cardClass }}">
    @if($title || isset($header))
        <div class="kt-card-header {{ $headerClass }}">
            @if($title)
                <h3 class="kt-card-title">
                    {{ $title }}
                </h3>
            @endif
            @isset($header)
                {{ $header }}
            @endisset
        </div>
    @endif
    
    <div class="kt-card-content  {{ $bodyClass }}">
        {{ $slot }}
    </div>
</div>
