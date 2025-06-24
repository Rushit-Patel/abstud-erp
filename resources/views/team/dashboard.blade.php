@php
$breadcrumbs = [
    ['title' => 'Home', 'url' => route('team.dashboard')],
    ['title' => 'Dashboard']
];
@endphp

<x-team.layout.app 
    title="Dashboard"
    :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
    
    <!-- Container -->
    <div class="kt-container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
                    Dashboard
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Central Hub for Personal Customization
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <a class="kt-btn kt-btn-outline" href="public-profile/profiles/default.html">
                    View Profile
                </a>
            </div>
        </div>
    </div>
    <!-- End of Container -->
    <!-- Container -->
    <div class="kt-container-fixed">
        <div class="grid gap-5 lg:gap-7.5">
            <!-- begin: grid -->
            <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">
                <div class="lg:col-span-1">
                    <div class="grid grid-cols-2 gap-5 lg:gap-7.5 h-full items-stretch">
                        <style>
                            .channel-stats-bg {
                                background-image: url('/default/images/2600x1600/bg-3.png');
                            }

                            .dark .channel-stats-bg {
                                background-image: url('/default/images/2600x1600/bg-3-dark.png');
                            }
                        </style>
                        <div
                            class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                            <img alt="" class="w-7 mt-4 ms-5"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/linkedin-2.svg" />
                            <div class="flex flex-col gap-1 pb-4 px-5">
                                <span class="text-3xl font-semibold text-mono">
                                    9.3k
                                </span>
                                <span class="text-sm font-normal text-secondary-foreground">
                                    Amazing mates
                                </span>
                            </div>
                        </div>
                        <div
                            class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                            <img alt="" class="w-7 mt-4 ms-5"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/youtube-2.svg" />
                            <div class="flex flex-col gap-1 pb-4 px-5">
                                <span class="text-3xl font-semibold text-mono">
                                    24k
                                </span>
                                <span class="text-sm font-normal text-secondary-foreground">
                                    Lessons Views
                                </span>
                            </div>
                        </div>
                        <div
                            class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                            <img alt="" class="w-7 mt-4 ms-5"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/instagram-03.svg" />
                            <div class="flex flex-col gap-1 pb-4 px-5">
                                <span class="text-3xl font-semibold text-mono">
                                    608
                                </span>
                                <span class="text-sm font-normal text-secondary-foreground">
                                    New subscribers
                                </span>
                            </div>
                        </div>
                        <div
                            class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                            <img alt="" class="dark:hidden w-7 mt-4 ms-5"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/tiktok.svg" />
                            <img alt="" class="hidden dark:block w-7 mt-4 ms-5"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/tiktok-dark.svg" />
                            <div class="flex flex-col gap-1 pb-4 px-5">
                                <span class="text-3xl font-semibold text-mono">
                                    2.5k
                                </span>
                                <span class="text-sm font-normal text-secondary-foreground">
                                    Stream audience
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <style>
                        .entry-callout-bg {
                            background-image: url('../../../static/metronic/tailwind/dist/assets/media/images/2600x1600/2.png');
                        }

                        .dark .entry-callout-bg {
                            background-image: url('../../../static/metronic/tailwind/dist/assets/media/images/2600x1600/2-dark.png');
                        }
                    </style>
                    <div class="kt-card h-full h-full">
                        <div
                            class="kt-card-content p-10 bg-[length:80%] rtl:[background-position:-70%_25%] [background-position:175%_25%] bg-no-repeat entry-callout-bg">
                            <div class="flex flex-col justify-center gap-4">
                                <div class="flex -space-x-2">
                                    <div class="flex">
                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-10"
                                            src="../../../static/metronic/tailwind/dist/assets/media/avatars/300-4.png" />
                                    </div>
                                    <div class="flex">
                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-10"
                                            src="../../../static/metronic/tailwind/dist/assets/media/avatars/300-1.png" />
                                    </div>
                                    <div class="flex">
                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-background size-10"
                                            src="../../../static/metronic/tailwind/dist/assets/media/avatars/300-2.png" />
                                    </div>
                                    <div class="flex">
                                        <span
                                            class="hover:z-5 relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-2xs size-10 text-white text-xs ring-background bg-green-500">
                                            S
                                        </span>
                                    </div>
                                </div>
                                <h2 class="text-xl font-semibold text-mono">
                                    Connect Today &amp; Join
                                    <br />
                                    the
                                    <a class="kt-link" href="#">
                                        KeenThemes
                                        Network
                                    </a>
                                </h2>
                                <p class="text-sm font-normal text-secondary-foreground leading-5.5">
                                    Enhance your projects
                                    with premium themes and
                                    <br />
                                    templates. Join the
                                    KeenThemes community
                                    today
                                    <br />
                                    for top-quality designs
                                    and resources.
                                </p>
                            </div>
                        </div>
                        <div class="kt-card-footer justify-center">
                            <a class="kt-link kt-link-underlined kt-link-dashed" href="account/home/get-started.html">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: grid -->
        </div>
    </div>
    <!-- End of Container -->
    </x-slot>
</x-team.layout.app>