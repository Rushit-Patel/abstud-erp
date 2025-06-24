@props([
    'icon' => 'ki-badge',
    'title' => 'Default Title',
    'description' => 'Default description',
    'link' => '#',
])

<div class="kt-card p-5 lg:p-7.5 lg:pt-7">
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between gap-2">
            <i class="ki-filled {{ $icon }} text-2xl text-primary">
            </i>
        </div>
        <div class="flex flex-col gap-3">
            <a class="text-base font-medium leading-none text-mono hover:text-primary"
                href="{{ $link }}">
                {{ $title }}
            </a>
            <span class="text-sm text-secondary-foreground leading-5">
                {{ $description }}
            </span>
        </div>
    </div>
</div>