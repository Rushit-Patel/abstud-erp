{{-- Team Notifications Component --}}
@props([
    'data' => [],
    'appData' => [],
    'showBadge' => true
])

@php
$notificationData = array_merge([
    'hasUnread' => false,
    'count' => 0,
    'items' => []
], $data);
@endphp

<!-- Notifications -->
<button class="kt-btn kt-btn-ghost kt-btn-icon size-9 rounded-full hover:bg-primary/10 hover:[&_i]:text-primary"
        data-kt-drawer-toggle="#notifications_drawer">
    <i class="ki-filled ki-notification-status text-lg"></i>
    @if($showBadge && $notificationData['hasUnread'])
        <span class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
            @if($notificationData['count'] > 9)
                9+
            @elseif($notificationData['count'] > 0)
                {{ $notificationData['count'] }}
            @endif
        </span>
    @endif
</button>

<!--Notifications Drawer-->
<div class="hidden kt-drawer kt-drawer-end card flex-col max-w-[90%] w-[450px] top-5 bottom-5 end-5 rounded-xl border border-border"
    data-kt-drawer="true" data-kt-drawer-container="body" id="notifications_drawer">
    <div class="flex items-center justify-between gap-2.5 text-sm text-mono font-semibold px-5 py-2.5 border-b border-b-border"
        id="notifications_header">
        Notifications
        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-dim shrink-0" data-kt-drawer-dismiss="true">
            <i class="ki-filled ki-cross">
            </i>
        </button>
    </div>
    <div class="kt-tabs kt-tabs-line justify-between px-5 mb-2" data-kt-tabs="true" id="notifications_tabs">
        <div class="flex items-center gap-5">
            <button class="kt-tab-toggle py-3 active" data-kt-tab-toggle="#notifications_tab_client">
                Client 
                <span
                    class="rounded-full bg-green-500 size-[5px] absolute top-2 rtl:start-0 end-0 transform translate-y-1/2 translate-x-full">
                </span>
            </button>
            <button class="kt-tab-toggle py-3" data-kt-tab-toggle="#notifications_tab_team">
                Team
            </button>
        </div>
    </div>
    <div class="grow flex flex-col" id="notifications_tab_client">
        <div class="grow kt-scrollable-y-auto" data-kt-scrollable="true" data-kt-scrollable-dependencies="#header"
            data-kt-scrollable-max-height="auto" data-kt-scrollable-offset="150px">
            <div class="flex flex-col gap-5 pt-3 pb-4">
                <div class="flex grow gap-2.5 px-5" id="notification_request_13">
                    <div class="flex items-center justify-center size-8 bg-blue-50 rounded-full border border-blue-200 dark:border-blue-950">
                        <i class="ki-filled ki-user-plus text-lg text-blue-500"></i>
                    </div>
                    <div class="flex flex-col gap-3.5 grow">
                        <div class="flex flex-col gap-1">
                            <div class="text-sm font-medium mb-px">
                                <span class="text-secondary-foreground">
                                    Assign New Inquiry:
                                </span>
                                <a class="hover:text-primary text-mono font-semibold" href="#">
                                    Rushit Patel
                                </a>
                            </div>
                            <span class="flex items-center text-xs font-medium text-muted-foreground">
                                22 hours ago
                                <span class="rounded-full size-1 bg-mono/30 mx-1.5">
                                </span>
                                Client Inquiry
                            </span>
                        </div>
                        <div
                            class="kt-card shadow-none flex items-center flex-row justify-between gap-1.5 px-2.5 py-2 rounded-lg bg-muted/70">
                            <div class="flex flex-col">
                                <span class="font-medium text-mono text-xs">
                                    Purpose: Student Visa
                                </span>
                                <span class="text-muted-foreground font-medium text-xs">
                                    Country: Canada
                                </span>
                            </div>
                            <a class="hover:text-primary text-secondary-foreground font-medium text-xs" href="#">
                                View Details
                            </a>
                        </div>
                        <div class="flex flex-wrap gap-2.5">
                            <button class="kt-btn kt-btn-outline kt-btn-sm" data-kt-dismiss="#notification_request_13">
                                Decline
                            </button>
                            <button class="kt-btn kt-btn-mono kt-btn-sm" data-kt-dismiss="#notification_request_13">
                                Accept
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-b border-b-border">
                </div>
                <div class="flex items-center grow gap-2.5 px-5">
                    <div
                        class="flex items-center justify-center size-8 bg-green-50 rounded-full border border-green-200 dark:border-green-950">
                        <i class="ki-filled ki-check text-lg text-green-500">
                        </i>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-medium text-secondary-foreground">
                            Client inquiry for Study Permit approved successfully
                        </span>
                        <span class="font-medium text-muted-foreground text-xs">
                            2 days ago
                        </span>
                    </div>
                </div>
                <div class="border-b border-b-border">
                </div>
                <div class="flex grow gap-2.5 px-5" id="notification_request_3">
                    <div class="flex items-center justify-center size-8 bg-orange-50 rounded-full border border-orange-200 dark:border-orange-950">
                        <i class="ki-filled ki-document text-lg text-orange-500"></i>
                    </div>
                    <div class="flex flex-col gap-3.5">
                        <div class="flex flex-col gap-1">
                            <div class="text-sm font-medium mb-px">
                                <span class="text-secondary-foreground">
                                    New Document Required:
                                </span>
                                <a class="hover:text-primary text-mono font-semibold" href="#">
                                    Priya Sharma
                                </a>
                            </div>
                            <span class="flex items-center text-xs font-medium text-muted-foreground">
                                4 days ago
                                <span class="rounded-full size-1 bg-mono/30 mx-1.5">
                                </span>
                                Work Permit
                            </span>
                        </div>
                        <div
                            class="kt-card shadow-none px-2.5 py-2 rounded-lg bg-muted/70">
                            <span class="text-xs text-secondary-foreground">
                                IELTS Score Report needed for Australia Work Permit application
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2.5">
                            <button class="kt-btn kt-btn-outline kt-btn-sm" data-kt-dismiss="#notification_request_3">
                                Request Document
                            </button>
                            <button class="kt-btn kt-btn-mono kt-btn-sm" data-kt-dismiss="#notification_request_3">
                                Mark Complete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-b border-b-border">
        </div>
        <div class="grid grid-cols-2 p-5 gap-2.5" id="notifications_inbox_footer">
            <button class="kt-btn kt-btn-outline justify-center">
                Archive all
            </button>
            <button class="kt-btn kt-btn-outline justify-center">
                Mark all as read
            </button>
        </div>
    </div>
    <div class="grow flex flex-col hidden" id="notifications_tab_team">
        <div class="grow kt-scrollable-y-auto" data-kt-scrollable="true" data-kt-scrollable-dependencies="#header"
            data-kt-scrollable-max-height="auto" data-kt-scrollable-offset="150px">
            <div class="flex flex-col gap-5 pt-3 pb-4">
                <div class="flex grow gap-2 px-5">
                    <div class="flex items-center justify-center size-8 bg-purple-50 rounded-full border border-purple-200 dark:border-purple-950">
                        <i class="ki-filled ki-calendar text-lg text-purple-500"></i>
                    </div>
                    <div class="flex flex-col gap-3 grow" id="notification_request_10">
                        <div class="flex flex-col gap-1">
                            <div class="text-sm font-medium mb-px">
                                <span class="text-secondary-foreground">
                                    New Leave Request:
                                </span>
                                <a class="hover:text-primary text-mono font-semibold" href="#">
                                    Milan Patel
                                </a>
                            </div>
                            <span class="flex items-center text-xs font-medium text-muted-foreground">
                                2 days ago
                                <span class="rounded-full size-1 bg-mono/30 mx-1.5">
                                </span>
                                HR Department
                            </span>
                        </div>
                        <div class="kt-card shadow-none p-2.5 rounded-lg bg-muted/70">
                            <div class="flex items-center justify-between flex-wrap gap-2.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="border border-primary/10 rounded-lg">
                                        <div
                                            class="flex items-center justify-center border-b border-b-primary/10 bg-primary/10 rounded-t-lg">
                                            <span class="text-xs text-primary fw-medium p-1.5">
                                                Jun
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-center size-9">
                                            <span class="fw-semibold text-mono text-md tracking-tight">
                                                10
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <span class="font-medium text-secondary-foreground text-xs">
                                            Annual Leave Request
                                        </span>
                                        <span class="font-medium text-secondary-foreground text-xs">
                                            Duration: 6 Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2.5">
                            <button class="kt-btn kt-btn-outline kt-btn-sm" data-kt-dismiss="#notification_request_10">
                                Decline
                            </button>
                            <button class="kt-btn kt-btn-mono kt-btn-sm" data-kt-dismiss="#notification_request_10">
                                Approve
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-b border-b-border">
                </div>
                <div class="flex grow gap-2.5 px-5">
                    <div class="flex items-center justify-center size-8 bg-yellow-50 rounded-full border border-yellow-200 dark:border-yellow-950">
                        <i class="ki-filled ki-time text-lg text-yellow-500"></i>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="text-sm font-medium mb-px">
                            <a class="hover:text-primary text-mono font-semibold" href="#">
                                Kavya Shah
                            </a>
                            <span class="text-secondary-foreground">
                                submitted timesheet for review
                            </span>
                        </div>
                        <span class="flex items-center text-xs font-medium text-muted-foreground">
                            1 day ago
                            <span class="rounded-full size-1 bg-mono/30 mx-1.5">
                            </span>
                            Operations Team
                        </span>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="border-b border-b-border">
        </div>
        <div class="grid grid-cols-2 p-5 gap-2.5" id="notifications_team_footer">
            <button class="kt-btn kt-btn-outline justify-center">
                Archive all
            </button>
            <button class="kt-btn kt-btn-outline justify-center">
                Mark all as read
            </button>
        </div>
    </div>
</div>
<!--End of Notifications Drawer-->