@php
    $breadcrumbs = [
        ['title' => 'Home', 'url' => route('team.dashboard')],
        ['title' => 'Dashboard']
    ];
@endphp

<x-team.layout.app title="Dashboard" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        {{-- <div class="kt-container-fixed">
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
        </div> --}}
        <div class="kt-container-fixed">
            <div class="grid gap-2 lg:gap-2">
                {{-- Lead Dashboard Start --}}
                <x-team.card title="Leads Statistics" headerClass="">
                    <x-slot name="header">
                        <div class="flex justify-between items-center">
                            <div class="kt-menu" data-kt-menu="true">
                                <button class="kt-btn kt-btn-icon kt-btn-outline"
                                    data-kt-modal-toggle="#leadFilterModal">
                                    <i class="ki-filled ki-filter"></i>
                                </button>
                            </div>
                        </div>
                    </x-slot>
                    <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch  pb-5">
                        <div class="lg:col-span-1">
                            <div class="grid grid-cols-2 gap-5 lg:gap-7.5 h-full items-stretch">
                                <style>
                                    .channel-stats-bg {
                                        background-image: url('default/images/2600x1600/bg-3.png');
                                    }

                                    .dark .channel-stats-bg {
                                        background-image: url('default/images/2600x1600/bg-3-dark.png');
                                    }
                                </style>
                                <div
                                    class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                                    <i class="ki-filled ki-users w-7 mt-4 ms-5 text-4xl text-primary"></i>
                                    <div class="flex flex-col gap-1 pb-4 px-5">
                                        <span class="text-3xl font-semibold text-mono">
                                            950
                                        </span>
                                        <span class="text-sm font-normal text-secondary-foreground">
                                            Total Leads
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                                    <i class="ki-filled ki-watch w-7 mt-4 ms-5 text-4xl text-primary"></i>
                                    <div class="flex flex-col gap-1 pb-4 px-5">
                                        <span class="text-3xl font-semibold text-mono">
                                            340
                                        </span>
                                        <span class="text-sm font-normal text-secondary-foreground">
                                            Open Leads
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                                    <i class="ki-filled ki-message-question w-7 mt-4 ms-5 text-4xl text-primary"></i>
                                    <div class="flex flex-col gap-1 pb-4 px-5">
                                        <span class="text-3xl font-semibold text-mono">
                                            208
                                        </span>
                                        <span class="text-sm font-normal text-secondary-foreground">
                                            Close Leads
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                                    <i class="ki-filled ki-security-user w-7 mt-4 ms-5 text-4xl text-primary"></i>
                                    <div class="flex flex-col gap-1 pb-4 px-5">
                                        <span class="text-3xl font-semibold text-mono">
                                            400
                                        </span>
                                        <span class="text-sm font-normal text-secondary-foreground">
                                            Registered
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-1">
                            <div class="kt-card h-full ">
                                <div class="kt-card-content ">
                                    <div id="lead_by_service_chart"></div>
                                </div>
                                <div class="kt-card-footer justify-center">
                                    <a class="kt-link kt-link-underlined kt-link-dashed" href="javascript:void(0);">
                                        Lead By Services
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-1">
                            <div class="kt-card h-full ">
                                <div class="kt-card-content p-0">
                                    <div id="top_performing_sales_team_chart"></div>
                                </div>
                                <div class="kt-card-footer justify-center">
                                    <a class="kt-link kt-link-underlined kt-link-dashed" href="javascript:void(0);">
                                        Top 5 Performers
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-team.card>

                {{-- Lead Dashboard End --}}

                {{-- Student Visa Dashboard Start --}}
                <x-team.card title="Student Visa Statistics" headerClass="">
                    <x-slot name="header">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="kt-menu" data-kt-menu="true">
                                    <button class="kt-btn kt-btn-icon kt-btn-outline"
                                        data-kt-modal-toggle="#studentVisaFilterModal">
                                        <i class="ki-filled ki-filter"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                    <div class="grid lg:grid-cols-2 gap-y-5 lg:gap-7.5 items-stretch mb-5">
                        <div class="lg:col-span-1">
                            <div class="grid lg:grid-cols-2 gap-y-5 lg:gap-4 items-stretch mb-5">
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-bank text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Applications
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                343
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i
                                                            class="ki-filled ki-questionnaire-tablet text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Offers
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                250
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-dollar text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Tution Fees
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                123
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-address-book text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Visa Applied
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                98
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-airplane text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Visa Approved
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                47
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-question text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Visa Rejected
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                5
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-1">
                            <div class="kt-card h-full ">
                                <div class="kt-card-content p-0">
                                    <div id="application_chart"></div>
                                </div>
                                <div class="kt-card-footer justify-center">
                                    <a class="kt-link kt-link-underlined kt-link-dashed" href="javascript:void(0);">
                                        Stage-wise Case Comparison
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-team.card>
                {{-- Student Visa Dashboard End --}}

                {{-- Coaching Statistics Start --}}
                <x-team.card title="Coaching Statistics" headerClass="">
                    <x-slot name="header">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="kt-menu" data-kt-menu="true">
                                    <button class="kt-btn kt-btn-icon kt-btn-outline"
                                        data-kt-modal-toggle="#studentVisaFilterModal">
                                        <i class="ki-filled ki-filter"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                    <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch mb-5">
                        <div class="lg:col-span-2">
                            <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-4 items-stretch mb-5">
                                <div class="lg:col-span-3">
                                    <div class="kt-card p-5">
                                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
                                            <div class="flex flex-col items-center justify-center text-center gap-1.5">
                                                <div
                                                    class="flex justify-center items-center size-14 rounded-full ring-1 ring-input bg-violet-50">
                                                    343
                                                </div>
                                                <div class="mt-1">
                                                    <span class="leading-none font-medium text-base text-primary">
                                                        Demo Students
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-center justify-center text-center gap-1.5">
                                                <div
                                                    class="flex justify-center items-center size-14 rounded-full ring-1 ring-input bg-violet-50">
                                                    34
                                                </div>
                                                <div class="mt-1">
                                                    <span class="leading-none font-medium text-base text-primary">
                                                        Not Attended
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-center justify-center text-center gap-1.5">
                                                <div
                                                    class="flex justify-center items-center size-14 rounded-full ring-1 ring-input bg-violet-50">
                                                    300
                                                </div>
                                                <div class="mt-1">
                                                    <span class="leading-none font-medium text-base text-primary">
                                                        Attended
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center justify-center text-center gap-1.5">
                                                <div
                                                    class="flex justify-center items-center size-14 rounded-full ring-1 ring-input bg-violet-50">
                                                    200
                                                </div>
                                                <div class="mt-1">
                                                    <span class="leading-none font-medium text-base text-primary">
                                                        Registered
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center justify-center text-center gap-1.5">
                                                <div
                                                    class="flex justify-center items-center size-14 rounded-full ring-1 ring-input bg-violet-50">
                                                    100
                                                </div>
                                                <div class="mt-1">
                                                    <span class="leading-none font-medium text-base text-primary">
                                                        Close
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-4 items-stretch mb-5">
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-archive-tick text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Registered
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                343
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-chart-line text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Active
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                250
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-double-check-circle text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Completed
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                123
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-calendar-tick text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Exam Book
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                98
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-like-tag text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Result Received
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                47
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex items-center gap-2.5">
                                                <div class="relative size-[30px] shrink-0">
                                                    <div
                                                        class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
                                                        <i class="ki-filled ki-airplane text-2xl text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <span class="leading-none font-medium text-base text-mono">
                                                        Visa File
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="font-semibold text-1xl text-foreground">
                                                5
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-1">
                            <div class="kt-card h-full">
                                {{-- <div class="kt-card-header">
                                    <h3 class="kt-card-title">
                                        Highlights
                                    </h3>
                                </div> --}}
                                <div class="kt-card-content flex flex-col gap-4 p-5 lg:p-7.5 lg:pt-4">
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-sm font-normal text-secondary-foreground">
                                            Active Coaching Students
                                        </span>
                                        <div class="flex items-center gap-2.5">
                                            <span class="text-3xl font-semibold text-mono">
                                                305
                                            </span>
                                            <span class="kt-badge kt-badge-outline kt-badge-success kt-badge-sm">
                                                +2.7%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 mb-1.5">
                                        <div class="bg-green-500 h-2 w-full max-w-[60%] rounded-xs">
                                        </div>
                                        <div class="bg-destructive h-2 w-full max-w-[25%] rounded-xs">
                                        </div>
                                        <div class="bg-violet-500 h-2 w-full max-w-[15%] rounded-xs">
                                        </div>
                                    </div>
                                    <div class="flex items-center flex-wrap gap-4 mb-1">
                                        <div class="flex items-center gap-1.5">
                                            <span class="rounded-full size-2 rounded-full kt-badge-success">
                                            </span>
                                            <span class="text-sm font-normal text-foreground">
                                                IELTS
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <span class="rounded-full size-2 rounded-full kt-badge-destructive">
                                            </span>
                                            <span class="text-sm font-normal text-foreground">
                                                PTE
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <span class="rounded-full size-2 rounded-full kt-badge-info">
                                            </span>
                                            <span class="text-sm font-normal text-foreground">
                                                TOEFL
                                            </span>
                                        </div>
                                    </div>
                                    <div class="border-b border-input">
                                    </div>
                                    <div class="grid gap-3">
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <div class="flex items-center gap-1.5">
                                                <i class="ki-filled ki-shop text-base text-muted-foreground">
                                                </i>
                                                <span class="text-sm font-normal text-mono">
                                                    IELTS
                                                </span>
                                            </div>
                                            <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                                <span class="lg:text-right">
                                                    200
                                                </span>
                                                <span class="lg:text-right">
                                                    3.9%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <div class="flex items-center gap-1.5">
                                                <i class="ki-filled ki-facebook text-base text-muted-foreground">
                                                </i>
                                                <span class="text-sm font-normal text-mono">
                                                    PTE
                                                </span>
                                            </div>
                                            <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                                <span class="lg:text-right">
                                                    87
                                                </span>
                                                <span class="lg:text-right">
                                                    0.7%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <div class="flex items-center gap-1.5">
                                                <i class="ki-filled ki-instagram text-base text-muted-foreground">
                                                </i>
                                                <span class="text-sm font-normal text-mono">
                                                    TOEFL
                                                </span>
                                            </div>
                                            <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                                <span class="lg:text-right">
                                                    36
                                                </span>
                                                <span class="lg:text-right">
                                                    
                                                    8.2%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-team.card>
                {{-- Coaching Statistics End --}}

                {{-- critical data Dashboard Start --}}
                <x-team.card title="Critical Data" headerClass="" cardClass="mb-10">
                   
                    <div class="grid lg:grid-cols-1 gap-y-5 lg:gap-7.5 items-stretch ">
                        <div class="lg:col-span-1">
                            <div class="grid lg:grid-cols-4 gap-y-5 lg:gap-4 items-stretch ">
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-accent/60 rounded-lg border border-input">
                                                    343
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Pending Follow Up
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground truncate w-full max-w-[10rem]"  data-kt-tooltip="#inactive_tooltip"
                                                    data-kt-tooltip-placement="bottom-start">
                                                        Count pending follow-ups (not completed) for the given date, linked to inquiries that are not closed.
                                                        <span data-kt-tooltip-content="true" class="kt-tooltip kt-tooltip-light">
                                                            Count pending follow-ups (not completed) for the given date, linked to inquiries that are not closed.
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-destructive/5 rounded-lg border border-input">
                                                    20
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Inactive Inquiry
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground truncate w-full max-w-[10rem]"  data-kt-tooltip="#inactive_tooltip"
                                                    data-kt-tooltip-placement="bottom-start">
                                                        counts inactive inquiries where the not marked as demo, not closed, not registered, inquiry date is 5 or more days old, and either the last follow-up was on or before 5 days ago or no follow-up exists.
                                                        <span data-kt-tooltip-content="true" class="kt-tooltip kt-tooltip-light">
                                                            counts inactive inquiries where the not marked as demo, not closed, not registered, inquiry date is 5 or more days old, and either the last follow-up was on or before 5 days ago or no follow-up exists.
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-destructive/5 rounded-lg border border-input">
                                                    4
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Inactive Demo
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground">
                                                        Description
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-accent/60 rounded-lg border border-input">
                                                    20
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Pending Payment
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground">
                                                        Description
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-accent/60 rounded-lg border border-input">
                                                    34
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Expiring Offer
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground">
                                                        Description
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-accent/60 rounded-lg border border-input">
                                                    5
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Upcoming Interview
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground">
                                                        Description
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-accent/60 rounded-lg border border-input">
                                                    0
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        Bio Matric
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground">
                                                        Description
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-1">
                                    <div class="kt-card p-5">
                                        <div class="flex flex-wrap items-center justify-between gap-5">
                                            <div class="flex align-start gap-3.5">
                                                <div class="flex items-center justify-center w-[2.875rem] h-[2.875rem] bg-accent/60 rounded-lg border border-input">
                                                    8
                                                </div>
                                                <div class="flex flex-col justify-start gap-1">
                                                    <span class="text-sm font-medium text-mono">
                                                        VFS
                                                    </span>
                                                    <span class="text-xs text-secondary-foreground">
                                                        Description
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-team.card>
                {{-- Student Visa Dashboard End --}}
            </div>
        </div>

        <!-- Lead Filter Modal start -->
        <x-team.modal id="leadFilterModal" title="Filter Leads" size="max-w-[500px]" position="top-[15%]">

            <div class="grid gap-4">
                <!-- Lead Status Filter -->
                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono">Date Range</label>
                    <select class="kt-input" id="lead_filter_date">
                        <option value="">All Data</option>
                        <option value="Yesterday">Yesterday</option>
                        <option value="Last 7 Days">Last 7 Days</option>
                        <option value="Last 30 Days">Last 30 Days</option>
                        <option value="Last Month">Last Month</option>
                        <option value="This Year">This Year</option>
                        <option value="Last Year">Last Year</option>
                        <option value="Custom">Custom Range</option>
                    </select>
                </div>
                <!-- Custom Date Range Picker -->
                <div class="flex flex-col gap-1" id="custom_date_range" style="display: none;">
                    <label class="kt-form-label font-normal text-mono">Custom Date Range</label>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="relative">
                            <input type="text" class="kt-input pl-10 pr-3" id="lead_filter_date_from"
                                placeholder="From Date" readonly>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ki-filled ki-calendar text-gray-400"></i>
                            </div>
                        </div>
                        <div class="relative">
                            <input type="text" class="kt-input pl-10 pr-3" id="lead_filter_date_to"
                                placeholder="To Date" readonly>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ki-filled ki-calendar text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Date Picker Calendar -->
                    <div class="relative">
                        <!-- Calendar Backdrop -->
                        <div id="calendar_backdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden"
                            style="z-index: 99998;"></div>

                        <!-- Calendar Modal -->
                        <div id="datepicker_calendar" class="fixed kt-card shadow-lg hidden"
                            style="min-width: 350px; z-index: 99999;">
                            <div class="kt-card-header">
                                <h3 class="kt-card-title text-sm">Select Date Range</h3>
                            </div>
                            <div class="kt-card-body p-4">
                                <!-- Calendar Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <button type="button" id="prev_month"
                                        class="kt-btn kt-btn-sm kt-btn-icon kt-btn-light">
                                        <i class="ki-filled ki-left text-sm"></i>
                                    </button>
                                    <div class="flex items-center gap-2">
                                        <select id="month_select"
                                            class="kt-select-sm form-select text-sm border-0 bg-transparent">
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">December</option>
                                        </select>
                                        <select id="year_select"
                                            class="kt-select-sm form-select text-sm border-0 bg-transparent"></select>
                                    </div>
                                    <button type="button" id="next_month"
                                        class="kt-btn kt-btn-sm kt-btn-icon kt-btn-light">
                                        <i class="ki-filled ki-right text-sm"></i>
                                    </button>
                                </div>

                                <!-- Calendar Grid -->
                                <div class="calendar-container">
                                    <div class="calendar-header grid grid-cols-7 gap-1 mb-2">
                                        <div class="calendar-day-header">Su</div>
                                        <div class="calendar-day-header">Mo</div>
                                        <div class="calendar-day-header">Tu</div>
                                        <div class="calendar-day-header">We</div>
                                        <div class="calendar-day-header">Th</div>
                                        <div class="calendar-day-header">Fr</div>
                                        <div class="calendar-day-header">Sa</div>
                                    </div>
                                    <div id="calendar_days" class="calendar-days grid grid-cols-7 gap-1"></div>
                                </div>
                            </div>
                            <div class="kt-card-footer">
                                <div class="flex justify-between items-center">
                                    <button type="button" id="clear_dates" class="kt-btn kt-btn-sm kt-btn-light">
                                        <i class="ki-filled ki-trash"></i>
                                        Clear
                                    </button>
                                    <div class="flex gap-2">
                                        <button type="button" id="cancel_selection"
                                            class="kt-btn kt-btn-sm kt-btn-secondary">
                                            Cancel
                                        </button>
                                        <button type="button" id="apply_selection"
                                            class="kt-btn kt-btn-sm kt-btn-primary">
                                            <i class="ki-filled ki-check"></i>
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono">Branch</label>
                    <select class="kt-input" id="lead_filter_branch">
                        <option value="">All</option>
                        <option value="HO">HO</option>
                        <option value="Ahmedabad">Ahmedabad</option>
                        <option value="Surat">Surat</option>
                        <option value="Vadodara">Vadodara</option>
                    </select>
                </div>

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-2.5">
                    <button class="kt-btn kt-btn-secondary" data-kt-modal-dismiss="#leadFilterModal">
                        Cancel
                    </button>
                    <button class="kt-btn kt-btn-outline" onclick="clearFilters()">
                        Clear Filters
                    </button>
                    <button class="kt-btn kt-btn-primary" onclick="applyFilters()">
                        <i class="ki-filled ki-check"></i>
                        Apply Filters
                    </button>
                </div>
            </x-slot>
        </x-team.modal>
        <!-- Lead Filter Modal End -->

    </x-slot>

    @push('scripts')
        <script>
            $(document).ready(function () {

               var colors = [
                    '#008FFB',
                    '#00E396',
                    '#FEB019',
                    '#FF4560',
                    '#FF4C60'
                ];
                var leadServiceChartOptions = {
                    series: [44, 55, 13, 43],
                    chart: {
                        type: 'pie',
                        height: 250,
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800
                        },
                        dropShadow: {
                            enabled: true,
                            top: 2,
                            left: 2,
                            blur: 4,
                            opacity: 0.2
                        }
                    },
                    colors: colors,
                    labels: ['Student Visa', 'Coaching', 'Visitor Visa', 'Dependent Visa'],
                    legend: {
                        position: 'bottom', // Legend at bottom
                        horizontalAlign: 'center', // Center the legend
                        fontFamily: 'Poppins, sans-serif',
                        fontSize: '12px',
                        offsetY: 10,
                        labels: {
                            colors: '#333'
                        },
                        markers: {
                            width: 12,
                            height: 12,
                            radius: 12
                        },
                        formatter: function(seriesName, opts) {
                            return seriesName + ': ' + opts.w.globals.series[opts.seriesIndex];
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '14px',
                            fontFamily: 'Poppins, sans-serif',
                            colors: ['#333']
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'diagonal1',
                            opacityFrom: 0.9,
                            opacityTo: 0.6
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom',
                                horizontalAlign: 'center'
                            }
                        }
                    }]
                };

                var leadServiceChart = new ApexCharts(document.querySelector("#lead_by_service_chart"), leadServiceChartOptions);
                leadServiceChart.render();

                var colors = [
                    '#008FFB',
                    '#00E396',
                    '#FEB019',
                    '#FF4560',
                    '#775DD0',
                ];
                var salesTeamChartOptions = {
                    series: [{
                        data: [50, 45, 30, 28, 25]
                    }],
                    chart: {
                        height: 270,
                        type: 'bar',
                        toolbar: {
                            show: false
                        },
                        events: {
                            click: function (chart, w, e) {

                            }
                        }
                    },
                    colors: colors,
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            borderRadius: 4,
                            columnWidth: '50%',
                            distributed: true,
                            endingShape: 'rounded'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        categories: [
                            ['Milan', 'Patel'],
                            ['Rushit', 'Patel'],
                            ['Smit', 'Patel'],
                            ['Parth', 'Butani'],
                            ['Yagnik', 'Ghediya'],
                        ],
                        labels: {
                            style: {
                                colors: colors,
                                fontSize: '12px'
                            }
                        }
                    }
                };

                var salesTeamChart = new ApexCharts(document.querySelector("#top_performing_sales_team_chart"), salesTeamChartOptions);
                salesTeamChart.render();



                var options = {
                    chart: {
                        type: 'bar',
                        height: 240,
                        toolbar: {
                            show: false
                        },
                    },
                    series: [{
                        name: 'Cases',
                        data: [343, 250, 123, 98, 47, 5]
                    }],
                    xaxis: {
                        categories: ['Applications', 'Offers', 'Tuition Fees', 'Visa Applied', 'Approved', ' Rejected']
                    },
                    colors: ['#343c7c'],
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            borderRadius: 4,
                            columnWidth: '50%',
                            endingShape: 'rounded'
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#application_chart"), options);
                chart.render();
            });

        </script>
    @endpush
</x-team.layout.app>