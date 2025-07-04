<?php

namespace App\Providers;

use App\Http\View\Composers\TeamAppComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\HeaderComposer;
use App\Http\View\Composers\BreadcrumbComposer;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        // Register Header View Composer
        View::composer('components.team.layout.app', TeamAppComposer::class);
        View::composer('components.team.auth.branding', TeamAppComposer::class);
        View::composer('welcome', TeamAppComposer::class);
        View::composer('components.team.forms.login-form', TeamAppComposer::class);
        View::composer('team.components.breadcrumbs', BreadcrumbComposer::class);


        Auth::provider('username_eloquent', function ($app, array $config) {
            return new UsernameUserProvider($app['hash'], $config['model']);
        });
        
        // Configure authentication redirects based on the request path
        Authenticate::redirectUsing(function ($request) {
            if ($request->is('team') || $request->is('team/*')) {
                return route('team.login');
            }
            if ($request->is('student') || $request->is('student/*')) {
                return route('team.login'); // Change this when student login is created
            }
            if ($request->is('partner') || $request->is('partner/*')) {
                return route('team.login'); // Change this when partner login is created
            }
            return route('team.login');
        });
    }
}
