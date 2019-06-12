<?php

namespace App\Providers;

use ReCaptcha\ReCaptcha;
use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Register Recaptcha service.
     */
    public function register()
    {
        $this->app->singleton(ReCaptcha::class, function ($app) {
            return new ReCaptcha(config('services.recaptcha.secret'));
        });
    }
}
