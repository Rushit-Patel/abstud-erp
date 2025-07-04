{{-- Team Auth Layout Component --}}
@props(['title' => 'Team Portal', 'showBranding' => true])

<!DOCTYPE html>
<html lang="en" class="h-full light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - AbstudERP</title>
    
    {{-- Team auth-specific styles --}}
    @vite(['resources/css/team/styles.css', 'resources/css/team/vendors/styles.bundle.css'])
</head>
<body class="antialiased flex h-full text-base text-foreground bg-background">
    <!-- Page -->
    <style>
        .branded-bg {
            background-image: url('/default/images/auth-banner.png');
        }
    </style>
    <div class="grid lg:grid-cols-2 grow">
        {{ $slot }}
        @if($showBranding)
            <x-team.auth.branding />
        @endif
    </div>
    {{ $footer ?? '' }}
    {{-- Team auth-specific scripts --}}
    @vite(['resources/js/team/core.bundle.js', 'resources/js/team/vendors/abstud.min.js'])
    {{-- Optional scripts --}}
</body>
</html>
