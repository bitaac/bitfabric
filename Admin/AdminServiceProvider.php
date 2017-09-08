<?php

namespace Bitaac\Admin;

use Bitaac\Admin\Http\Middleware;
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
}
