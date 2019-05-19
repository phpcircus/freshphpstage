<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->shareWithInertia();
    }

    /**
     * Configure and share data with Inertia.
     */
    protected function shareWithInertia()
    {
        Inertia::version(static function () {
            return md5_file(public_path('mix-manifest.json'));
        });
        Inertia::share('app.name', Config::get('app.name'));
        Inertia::share('errors', static function () {
            return Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object) [];
        });
        Inertia::share('notification', static function () {
            return Session::get('notification') ? Session::get('notification') : (string) '';
        });
        Inertia::share('warning', static function () {
            return Session::get('warning') ? Session::get('warning') : (string) '';
        });
        Inertia::share('auth.user', static function () {
            if (Auth::user()) {
                return [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ];
            }
        });
    }
}
