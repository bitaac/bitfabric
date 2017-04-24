<?php

namespace Bitaac\Admin;

use Bitaac\Admin\Http\Middleware;
use Bitaac\Core\Providers\AggregateServiceProvider;

class AdminServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Admin\Http\Controllers' => __DIR__.'/Http/routes.php',
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
