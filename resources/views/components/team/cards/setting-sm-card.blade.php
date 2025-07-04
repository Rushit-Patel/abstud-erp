@props([
    'icon' => '',
    'title' => 'Default Title',
    'description' => '',
    'link' => '#',
])
<div class="kt-card">
    <div class="kt-card-content flex items-center gap-3.5 px-5">
        @if($icon!='')
        <div class="relative size-[35px] shrink-0">
            <svg class="w-full h-full stroke-primary/10 fill-primary-soft" fill="none" height="44" viewBox="0 0 44 48"
                width="40" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 2.4641C19.7128 0.320509 24.2872 0.320508 28 2.4641L37.6506 8.0359C41.3634 10.1795 43.6506 14.141 43.6506 18.4282V29.5718C43.6506 33.859 41.3634 37.8205 37.6506 39.9641L28 45.5359C24.2872 47.6795 19.7128 47.6795 16 45.5359L6.34937 39.9641C2.63655 37.8205 0.349365 33.859 0.349365 29.5718V18.4282C0.349365 14.141 2.63655 10.1795 6.34937 8.0359L16 2.4641Z" fill=""></path>
                <path d="M16.25 2.89711C19.8081 0.842838 24.1919 0.842837 27.75 2.89711L37.4006 8.46891C40.9587 10.5232 43.1506 14.3196 43.1506 18.4282V29.5718C43.1506 33.6804 40.9587 37.4768 37.4006 39.5311L27.75 45.1029C24.1919 47.1572 19.8081 47.1572 16.25 45.1029L6.59937 39.5311C3.04125 37.4768 0.849365 33.6803 0.849365 29.5718V18.4282C0.849365 14.3196 3.04125 10.5232 6.59937 8.46891L16.25 2.89711Z" stroke=""></path>
            </svg>
            <div class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                <i class="ki-filled ki-{{ $icon }} text-md ps-px text-primary">
                </i>
            </div>
        </div>
        @endif
        <div class="flex flex-col">
            <a class="hover:text-primary  text-mono kt-link kt-link-underlined kt-link-dashed" href="{{ $link }}">
                {{ $title }}
            </a>
            
            @if($description!='')
            <span class="text-xs font-normal text-secondary-foreground">
                {{ $description }}
            </span>
            @endif
        </div>
    </div>
</div>