<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your action routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $actionNamespace = 'App\Http\Actions';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapActionRoutes();
    }

    /**
     * Define the "action" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapActionRoutes()
    {
        Route::middleware('web')
            ->namespace($this->actionNamespace)
            ->group(base_path('routes/actions.php'));
    }
}
