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
        {{-- <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
            <div class="kt-card max-w-[370px] w-full">
                <form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="get">
                    <div class="text-center mb-2.5">
                        <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                            Sign in
                        </h3>
                        <div class="flex items-center justify-center font-medium">
                            <span class="text-sm text-secondary-foreground me-1.5">
                                Need an account?
                            </span>
                            <a class="text-sm link" href="sign-up/index.html">
                                Sign up
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5">
                        <a class="kt-btn kt-btn-outline justify-center" href="#">
                            <img alt="" class="size-3.5 shrink-0"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/google.svg" />
                            Use Google
                        </a>
                        <a class="kt-btn kt-btn-outline justify-center" href="#">
                            <img alt="" class="size-3.5 shrink-0 dark:hidden"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/apple-black.svg" />
                            <img alt="" class="size-3.5 shrink-0 light:hidden"
                                src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/apple-white.svg" />
                            Use Apple
                        </a>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="border-t border-border w-full">
                        </span>
                        <span class="text-xs text-muted-foreground font-medium uppercase">
                            Or
                        </span>
                        <span class="border-t border-border w-full">
                        </span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label font-normal text-mono">
                            Email
                        </label>
                        <input class="kt-input" placeholder="email@email.com" type="text" value="" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center justify-between gap-1">
                            <label class="kt-form-label font-normal text-mono">
                                Password
                            </label>
                            <a class="text-sm kt-link shrink-0" href="reset-password/enter-email/index.html">
                                Forgot Password?
                            </a>
                        </div>
                        <div class="kt-input" data-kt-toggle-password="true">
                            <input name="user_password" placeholder="Enter Password" type="password" value="" />
                            <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                                data-kt-toggle-password-trigger="true" type="button">
                                <span class="kt-toggle-password-active:hidden">
                                    <i class="ki-filled ki-eye text-muted-foreground">
                                    </i>
                                </span>
                                <span class="hidden kt-toggle-password-active:block">
                                    <i class="ki-filled ki-eye-slash text-muted-foreground">
                                    </i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <label class="kt-label">
                        <input class="kt-checkbox kt-checkbox-sm" name="check" type="checkbox" value="1" />
                        <span class="kt-checkbox-label">
                            Remember me
                        </span>
                    </label>
                    <button class="kt-btn kt-btn-primary flex justify-center grow">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
         --}}
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
