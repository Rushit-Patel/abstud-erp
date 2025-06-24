{{-- Team Login Form Component --}}
@props([
    'action',
    'method' => 'POST'
])
<div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
    <div class="kt-card max-w-[370px] w-full">
        <div class="kt-card-content flex flex-col gap-5 p-10">
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
                <span class="border-t border-border w-full"></span>
                <span class="text-xs text-muted-foreground font-medium uppercase">
                    Or
                </span>
                <span class="border-t border-border w-full"></span>
            </div>
            <form class=" flex flex-col gap-5" id="sign_in_form" action="{{ $action }}" method="{{ $method }}">
                @csrf
                {{ $slot }}
            </form>
        </div>
    </div>
</div>