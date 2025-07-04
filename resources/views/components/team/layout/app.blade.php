<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
<head>
    <title>
        {{ $title }} | {{ $appData['companyName'] }}
    </title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="follow, index" name="robots" />
    <link href="works.html" rel="canonical" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="{{ $appData['companyFavicon'] }}" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    
    @vite([
        'resources/css/team/vendors/apexcharts.css',
        'resources/css/team/vendors/styles.bundle.css',
        'resources/css/team/styles.css',
        'resources/css/app.css',
    ])
    
    @stack('styles')
</head>

@props([
    'title' => 'Dashboard',
    'breadcrumbs' => [],
    'showNotifications' => true,
    'showChat' => true,
    'showApps' => true,
    'showUserMenu' => true
])

<body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">
    <script>
        const defaultThemeMode = 'light';
        let themeMode;
        if (document.documentElement) {
            if (localStorage.getItem('kt-theme')) {
                themeMode = localStorage.getItem('kt-theme');
            } else if (
                document.documentElement.hasAttribute('data-kt-theme-mode')
            ) {
                themeMode =
                        document.documentElement.getAttribute('data-kt-theme-mode');
            } else {
                themeMode = defaultThemeMode;
            }

            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches
                        ? 'dark'
                        : 'light';
            }
            document.documentElement.classList.add(themeMode);
        }
    </script>
    <div class="flex grow">
        <x-team.navigation.sidebar :appData="$appData" />
        <div class="kt-wrapper flex grow flex-col">
            <x-team.layout.header 
                :title="$title" 
                :appData="$appData" 
                :breadcrumbs="$breadcrumbs"
                :showNotifications="$showNotifications"
                :showChat="$showChat"
                :showApps="$showApps"
                :showUserMenu="$showUserMenu" />
            <main class="grow pt-5" id="content" role="content">
                {{ $content }}
            </main>
        </div>
    </div>
    <!-- jQuery Full Version -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    @vite([
        'resources/js/team/core.bundle.js', 
        'resources/js/team/vendors/abstud.min.js',
        'resources/js/team/vendors/apexcharts.min.js',
        'resources/js/team/vendors/general.js',
        'resources/js/team/vendors/demo.js',
    ])
    
    @stack('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global Toast Handler for Laravel Session Messages
            function initGlobalToasts() {
                // Handle success messages
                @if(session('success'))
                    KTToast.show({
                        message: "{{ session('success') }}",
                        icon: '<i class="ki-filled ki-check text-success text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "success",
                        duration: 5000
                    });
                @endif

                // Handle error messages
                @if(session('error'))
                    KTToast.show({
                        message: "{{ session('error') }}",
                        icon: '<i class="ki-filled ki-information-4 text-danger text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "destructive",
                        duration: 7000
                    });
                @endif

                // Handle warning messages
                @if(session('warning'))
                    KTToast.show({
                        message: "{{ session('warning') }}",
                        icon: '<i class="ki-filled ki-information-2 text-warning text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "warning",
                        duration: 6000
                    });
                @endif

                // Handle info messages
                @if(session('info'))
                    KTToast.show({
                        message: "{{ session('info') }}",
                        icon: '<i class="ki-filled ki-information text-info text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "info",
                        duration: 5000
                    });
                @endif

                // Handle validation errors
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        KTToast.show({
                            message: "{{ $error }}",
                            icon: '<i class="ki-filled ki-information-4 text-warning text-xl"></i>',
                            progress: true,
                            pauseOnHover: true,
                            variant: "warning",
                            duration: 6000
                        });
                    @endforeach
                @endif
            }

            // Initialize global toasts
            initGlobalToasts();

            // Global utility functions for showing toasts programmatically
            window.showToast = {
                success: function(message, options = {}) {
                    KTToast.show({
                        message: message,
                        icon: '<i class="ki-filled ki-check text-success text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "success",
                        duration: 5000,
                        ...options
                    });
                },
                error: function(message, options = {}) {
                    KTToast.show({
                        message: message,
                        icon: '<i class="ki-filled ki-information-4 text-danger text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "destructive",
                        duration: 7000,
                        ...options
                    });
                },
                warning: function(message, options = {}) {
                    KTToast.show({
                        message: message,
                        icon: '<i class="ki-filled ki-information-2 text-warning text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "warning",
                        duration: 6000,
                        ...options
                    });
                },
                info: function(message, options = {}) {
                    KTToast.show({
                        message: message,
                        icon: '<i class="ki-filled ki-information text-info text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "info",
                        duration: 5000,
                        ...options
                    });
                },
                loading: function(message, options = {}) {
                    KTToast.show({
                        message: message,
                        icon: '<i class="ki-filled ki-loading text-info text-xl"></i>',
                        progress: true,
                        pauseOnHover: true,
                        variant: "info",
                        duration: 3000,
                        ...options
                    });
                }
            };

            // Global form submission handler for delete confirmations
            window.initDeleteConfirmation = function(selector = 'form[action*="destroy"]') {
                document.querySelectorAll(selector).forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                            // Show loading toast
                            window.showToast.loading("Processing deletion...");
                            
                            // Submit the form
                            this.submit();
                        }
                    });
                });
            };

            // Auto-initialize delete confirmations for common patterns
            window.initDeleteConfirmation();
        });
    </script>
    <div class="kt-modal" data-kt-modal="true" id="search_modal">
        <div class="kt-modal-content max-w-[600px] top-[15%]">
            <div class="kt-modal-header py-4 px-5">
                <i class="ki-filled ki-magnifier text-muted-foreground text-xl">
                </i>
                <input class="kt-input kt-input-ghost" name="query" placeholder="Tap to start search" type="text"
                    value="" />
                <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-dim shrink-0" data-kt-modal-dismiss="true">
                    <i class="ki-filled ki-cross">
                    </i>
                </button>
            </div>
            <div class="kt-modal-body p-0 pb-5">
                <div class="kt-tabs kt-tabs-line justify-between px-5 mb-2.5" data-kt-tabs="true">
                    <div class="flex items-center gap-5">
                        <button class="kt-tab-toggle py-5 active" data-kt-tab-toggle="#search_modal_mixed">
                            Leads
                        </button>
                        {{-- <button class="kt-tab-toggle py-5" data-kt-tab-toggle="#search_modal_settings">
                            Settings
                        </button> --}}
                    </div>
                </div>
                <div class="kt-scrollable-y-auto" data-kt-scrollable="true" data-kt-scrollable-max-height="auto"
                    data-kt-scrollable-offset="300px">
                    <div class="" id="search_modal_mixed">
                        <div class="kt-menu kt-menu-default px-0.5 flex-col">
                            <div class="grid gap-1">
                                <div class="kt-menu-item">
                                    <div class="kt-menu-link flex justify-between gap-2">
                                        <div class="flex items-center gap-2.5">
                                            <div class="flex flex-col">
                                                <a class="text-sm font-semibold text-mono hover:text-primary mb-px"
                                                    href="#">
                                                    Rushit Patel
                                                </a>
                                                <span class="text-2sm font-normal text-muted-foreground">
                                                    projects@abstud.io
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <div class="kt-badge rounded-full kt-badge-outline kt-badge-success gap-1.5">
                                                <span class="kt-badge-dot"></span>
                                                IN COACHING
                                            </div>
                                            <button class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm">
                                                <i class="ki-filled ki-dots-vertical text-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-menu kt-menu-default px-0.5 flex-col">
                            <div class="grid gap-1">
                                <div class="kt-menu-item">
                                    <div class="kt-menu-link flex justify-between gap-2">
                                        <div class="flex items-center gap-2.5">
                                            <div class="flex flex-col">
                                                <a class="text-sm font-semibold text-mono hover:text-primary mb-px"
                                                    href="#">
                                                    Milan Patel
                                                </a>
                                                <span class="text-2sm font-normal text-muted-foreground">
                                                    milan@abstud.io
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <div class="kt-badge rounded-full kt-badge-outline kt-badge-primary gap-1.5">
                                                <span class="kt-badge-dot"></span>
                                                IN INQUIRY
                                            </div>
                                            <button class="kt-btn kt-btn-icon kt-btn-ghost kt-btn-sm">
                                                <i class="ki-filled ki-dots-vertical text-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
