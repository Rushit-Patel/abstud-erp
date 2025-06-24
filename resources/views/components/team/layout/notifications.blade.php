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
              <i class="ki-filled ki-cross"></i>
         </button>
    </div>
    <div class="kt-tabs kt-tabs-line justify-between px-5 mb-2" data-kt-tabs="true"
         id="notifications_tabs">
         <div class="flex items-center gap-5">
              <button class="kt-tab-toggle py-3 active" data-kt-tab-toggle="#notifications_tab_all">
                   All
              </button>
              <button class="kt-tab-toggle py-3 relative" data-kt-tab-toggle="#notifications_tab_inbox">
                   Inbox
                   @if($notificationData['hasUnread'])
                   <span class="rounded-full bg-green-500 size-[5px] absolute top-2 rtl:start-0 end-0 transform translate-y-1/2 translate-x-full"></span>
                   @endif
              </button>
              <button class="kt-tab-toggle py-3" data-kt-tab-toggle="#notifications_tab_team">
                   Team
              </button>
              <button class="kt-tab-toggle py-3" data-kt-tab-toggle="#notifications_tab_following">
                   Following
              </button>
         </div>
         <div class="kt-menu" data-kt-menu="true">
              <div class="kt-menu-item" data-kt-menu-item-offset="0,10px"
                   data-kt-menu-item-placement="bottom-end"
                   data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown"
                   data-kt-menu-item-trigger="click|lg:hover">
                   <button class="kt-menu-toggle kt-btn kt-btn-icon kt-btn-ghost">
                        <i class="ki-filled ki-setting-2"></i>
                   </button>
                   <div class="kt-menu-dropdown kt-menu-default w-full max-w-[175px]"
                        data-kt-menu-dismiss="true">
                        <div class="kt-menu-item">
                             <a class="kt-menu-link" href="#">
                                  <span class="kt-menu-icon">
                                       <i class="ki-filled ki-document"></i>
                                  </span>
                                  <span class="kt-menu-title">View</span>
                             </a>
                        </div>
                        <div class="kt-menu-item">
                             <a class="kt-menu-link" href="#">
                                  <span class="kt-menu-icon">
                                       <i class="ki-filled ki-pencil"></i>
                                  </span>
                                  <span class="kt-menu-title">Edit</span>
                             </a>
                        </div>
                        <div class="kt-menu-item">
                             <a class="kt-menu-link" href="#">
                                  <span class="kt-menu-icon">
                                       <i class="ki-filled ki-trash"></i>
                                  </span>
                                  <span class="kt-menu-title">Delete</span>
                             </a>
                        </div>
                   </div>
              </div>
         </div>
    </div>
    
    <!-- Notification Content -->
    <div class="kt-scrollable-y-auto flex-1 px-5 py-3">
        @if(count($notificationData['items']) > 0)
            @foreach($notificationData['items'] as $notification)
                <div class="flex items-start gap-3 p-3 hover:bg-accent/20 rounded-lg transition-colors">
                    <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                        <i class="ki-filled ki-notification text-primary text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-foreground">{{ $notification['title'] ?? 'Notification' }}</h4>
                        <p class="text-xs text-muted-foreground mt-1">{{ $notification['message'] ?? '' }}</p>
                        <span class="text-xs text-muted-foreground">{{ $notification['time'] ?? 'Just now' }}</span>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <i class="ki-filled ki-notification-status text-4xl text-muted-foreground mb-2"></i>
                <p class="text-sm text-muted-foreground">No notifications yet</p>
            </div>
        @endif
    </div>
</div>
<!--End of Notifications Drawer-->