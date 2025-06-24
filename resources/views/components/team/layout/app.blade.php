<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
<head>
    <title>
        {{ $title }} | {{ $appData['companyName'] }}
    </title>
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <link href="works.html" rel="canonical" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="{{ $appData['companyFavicon'] }}" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    
    @vite([
        'resources/css/team/vendors/apexcharts.css',
        'resources/css/team/vendors/styles.bundle.css',
        'resources/css/team/styles.css',
    ])
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
    </script>    <div class="flex grow">
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
    @vite([
        'resources/js/team/core.bundle.js', 
        'resources/js/team/vendors/abstud.min.js',
        'resources/js/team/vendors/apexcharts.min.js',
        'resources/js/team/vendors/general.js',
        'resources/js/team/vendors/demo.js',
    ])
</body>
</html>
