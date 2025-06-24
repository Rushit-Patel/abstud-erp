{{-- Sidebar Menu Item Component --}}
@props([
    'icon' => '',
    'label' => '',
    'route' => '',
    'url' => '',
    'active' => false,
    'hasSubmenu' => false,
    'isExpanded' => false,
    'isSubmenuItem' => false,
    'badge' => null,
    'target' => '_self'
])

@php
if ($route && \Route::has($route)) {
    $href = route($route);
} else {
    $href = "#";
}

$isActive = $active === true || ($active && request()->routeIs($active));
$classes = [
    'kt-menu-link',
    'border border-transparent',
    'items-center',
    'grow',
    $hasSubmenu ? 'cursor-pointer' : '',
    $isActive ? 'kt-menu-item-active:bg-accent/60 dark:menu-item-active:border-border kt-menu-item-active:rounded-lg' : '',
    'hover:bg-accent/60 hover:rounded-lg',
    'gap-[' . ($isSubmenuItem ? '14px' : '10px') . ']',
    'ps-[10px] pe-[10px]',
    'py-[' . ($hasSubmenu && !$isSubmenuItem ? '6px' : '8px') . ']'
];
$linkClasses = implode(' ', array_filter($classes));
@endphp

<div class="kt-menu-item {{ $isActive ? 'active' : '' }} {{ $hasSubmenu && $isExpanded ? 'show' : '' }}"
     @if($hasSubmenu) 
         data-kt-menu-item-toggle="accordion" data-kt-menu-item-trigger="click"
     @endif>
    
    @if($hasSubmenu)
        {{-- Menu item with submenu --}}
        <div class="{{ $linkClasses }}" tabindex="0">
            @if($icon && !$isSubmenuItem)
                <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                    <i class="{{ $icon }} text-lg"></i>
                </span>
            @elseif($isSubmenuItem)
                <span class="kt-menu-bullet flex w-[6px] -start-[3px] rtl:start-0 relative before:absolute before:top-0 before:size-[6px] before:rounded-full rtl:before:translate-x-1/2 before:-translate-y-1/2 kt-menu-item-active:before:bg-primary kt-menu-item-hover:before:bg-primary">
                </span>
            @endif
            
            <span class="kt-menu-title text-{{ $isSubmenuItem ? '2sm' : 'sm' }} font-{{ $isSubmenuItem ? 'normal' : 'medium' }} {{ $isSubmenuItem ? 'me-1' : '' }} text-foreground kt-menu-item-active:text-primary kt-menu-item-active:font-{{ $isSubmenuItem ? 'medium' : 'semibold' }} kt-menu-link-hover:!text-primary">
                {{ $label }}
            </span>
            
            @if($badge)
                <span class="kt-menu-badge flex items-center justify-center bg-primary text-primary-foreground text-2xs font-medium rounded-full min-w-[18px] h-[18px] px-1.5">
                    {{ $badge }}
                </span>
            @endif
            
            <span class="kt-menu-arrow text-muted-foreground w-[20px] shrink-0 justify-end ms-1 me-[-10px]">
                <span class="inline-flex kt-menu-item-show:hidden">
                    <i class="ki-filled ki-plus text-[11px]"></i>
                </span>
                <span class="hidden kt-menu-item-show:inline-flex">
                    <i class="ki-filled ki-minus text-[11px]"></i>
                </span>
            </span>
        </div>
        
        {{-- Submenu content slot --}}
        <div class="kt-menu-accordion gap-1 {{ $isSubmenuItem ? 'relative before:absolute before:start-[32px] ps-[22px] before:top-0 before:bottom-0 before:border-s before:border-border' : 'ps-[10px] relative before:absolute before:start-[20px] before:top-0 before:bottom-0 before:border-s before:border-border' }}">
            {{ $slot }}
        </div>
    @else
        {{-- Regular menu link --}}
        <a class="{{ $linkClasses }}" href="{{ $href }}" target="{{ $target }}" tabindex="0">
            @if($icon && !$isSubmenuItem)
                <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                    <i class="{{ $icon }} text-lg"></i>
                </span>
            @elseif($isSubmenuItem)
                <span class="kt-menu-bullet flex w-[6px] -start-[3px] rtl:start-0 relative before:absolute before:top-0 before:size-[6px] before:rounded-full rtl:before:translate-x-1/2 before:-translate-y-1/2 kt-menu-item-active:before:bg-primary kt-menu-item-hover:before:bg-primary">
                </span>
            @endif
            
            <span class="kt-menu-title text-{{ $isSubmenuItem ? '2sm' : 'sm' }} font-{{ $isSubmenuItem ? 'normal' : 'medium' }} text-foreground kt-menu-item-active:text-primary kt-menu-item-active:font-semibold kt-menu-link-hover:!text-primary">
                {{ $label }}
            </span>
            
            @if($badge)
                <span class="kt-menu-badge flex items-center justify-center bg-primary text-primary-foreground text-2xs font-medium rounded-full min-w-[18px] h-[18px] px-1.5">
                    {{ $badge }}
                </span>
            @endif
        </a>
    @endif
</div>
