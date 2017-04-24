<?php

namespace Bitaac\Store;

use Illuminate\Http\Response;
use Bitaac\Store\Http\Middleware;
use Bitaac\Core\Providers\AggregateServiceProvider;
use Bitaac\Store\Exceptions\NotFoundProductException;

class StoreServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Store\Http\Controllers' => __DIR__.'/Http/routes.php',
    ];

    /**
     * The provider migration paths.
     *
     * @var array
     */
    protected $migrations = [
        __DIR__.'/Resources/Migrations',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'can.claim' => Middleware\CanClaimMiddleware::class,
    ];

    /**
     * Holds all contracts and models we want to bind.
     *
     * @var array
     */
    protected $bindings = [
        'store.product' => [\Bitaac\Contracts\StoreProduct::class => \Bitaac\Store\Models\StoreProduct::class],
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__.'/Resources/Config' => config_path('bitaac'),
        ], 'config');

        $this->exceptions->handle(NotFoundProductException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });
    }
}
