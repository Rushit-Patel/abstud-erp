{{-- Team Sidebar Component --}}
@props([
    'appData' => []
])
{{-- Main Sidebar Container --}}
<div class="kt-sidebar bg-background border-e border-e-border fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]" data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0" id="sidebar">
    {{-- Sidebar Header --}}
    <x-team.navigation.sidebar-header :appData="$appData" />

    {{-- Sidebar Content --}}
    <div class="kt-sidebar-content flex grow shrink-0 py-5 pe-2" id="sidebar_content">
        <div class="kt-scrollable-y-hover grow shrink-0 flex ps-2 lg:ps-5 pe-1 lg:pe-3"
            data-kt-scrollable="true" data-kt-scrollable-dependencies="#sidebar_header"
            data-kt-scrollable-height="auto" data-kt-scrollable-offset="0px"
            data-kt-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">

            {{-- Sidebar Menu --}}
            <div class="kt-menu flex flex-col grow gap-1" data-kt-menu="true" data-kt-menu-accordion-expand-all="false" id="sidebar_menu">

                {{-- Dashboards Section --}}
                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-element-11"
                    label="Dashboards"
                    route="team.dashboard"
                    :hasSubmenu="false">
                </x-team.navigation.sidebar-menu-item>

                <x-team.navigation.sidebar-heading label="Lead Management" />

                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-people"
                    label="Leads"
                    route="team.leads"
                    :hasSubmenu="false">
                </x-team.navigation.sidebar-menu-item>


                <x-team.navigation.sidebar-heading label="Coaching Management" />

                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-abstract-37"
                    label="Demo"
                    route="team.demo.index"
                    :hasSubmenu="false">
                </x-team.navigation.sidebar-menu-item>

                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-book-open"
                    label="Coachings"
                    route="team.coachings.index"
                    :hasSubmenu="false">
                </x-team.navigation.sidebar-menu-item>

                <x-team.navigation.sidebar-heading label="Visa Filing" />

                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-bank"
                    label="Student Visa"
                    route="team.student-visa.index"
                    :hasSubmenu="false">
                </x-team.navigation.sidebar-menu-item>

                {{-- Settings Section --}}
                <x-team.navigation.sidebar-heading label="Settings" />

                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-setting-2"
                    label="Company Settings"
                    route="team.settings.index"
                    :hasSubmenu="false">
                </x-team.navigation.sidebar-menu-item>
            {{--
                <x-team.navigation.sidebar-menu-item
                    icon="ki-filled ki-profile-circle"
                    label="Public Profile"
                    :hasSubmenu="true"
                    :isExpanded="true">

                <x-team.navigation.sidebar-menu-item
                    label="Profiles"
                    :hasSubmenu="true"
                    :isSubmenuItem="true">

                    <x-team.navigation.sidebar-menu-item
                        label="Creator"
                        route="team.profile.creator"
                        :isSubmenuItem="true" />

                    <x-team.navigation.sidebar-menu-item
                        label="Company"
                        route="team.profile.company"
                        :isSubmenuItem="true" />

                    <x-team.navigation.sidebar-menu-item
                        label="NFT"
                        route="team.profile.nft"
                        :isSubmenuItem="true" />

                    <x-team.navigation.sidebar-menu-item
                        label="Blogger"
                        route="team.profile.blogger"
                        :isSubmenuItem="true" />

                    <x-team.navigation.sidebar-menu-item
                        label="CRM"
                        route="team.profile.crm"
                        :isSubmenuItem="true" />

                        <x-team.navigation.sidebar-show-more showText="Show 4 more">
                            <x-team.navigation.sidebar-menu-item
                                label="Gamer"
                                route="team.profile.gamer"
                                :isSubmenuItem="true" />

                            <x-team.navigation.sidebar-menu-item
                                label="Feeds"
                                route="team.profile.feeds"
                                :isSubmenuItem="true" />

                            <x-team.navigation.sidebar-menu-item
                                label="Plain"
                                route="team.profile.plain"
                                :isSubmenuItem="true" />

                            <x-team.navigation.sidebar-menu-item
                                label="Modal"
                                route="team.profile.modal"
                                :isSubmenuItem="true" />
                        </x-team.navigation.sidebar-show-more>
                    </x-team.navigation.sidebar-menu-item>
                </x-team.navigation.sidebar-menu-item> --}}

                {{ $slot }}
            </div>
        </div>
    </div>
</div>
