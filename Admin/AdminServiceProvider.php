<?php

namespace Bitaac\Admin;

use Bitaac\Admin\Http\Middleware;
use Illuminate\Support\Facades\View;
use Bitaac\Admin\RouteServiceProvider;
use Bitaac\Core\Providers\AggregateServiceProvider;

class AdminServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        RouteServiceProvider::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin' => Middleware\AdminMiddleware::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->app->singleton('Bitaac\Admin\Navbar\Navbar', function () {
            return new \Bitaac\Admin\Navbar\Navbar;
        });

        $navbar = resolve('Bitaac\Admin\Navbar\Navbar');

        View::composer('admin::layouts.app', function ($view) use ($navbar) {
            $view->with('navbar', $navbar);
        });
    }
}
