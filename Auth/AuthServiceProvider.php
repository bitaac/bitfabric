<?php

namespace Bitaac\Auth;

use Bitaac\Account\Http\Middleware;
use Bitaac\Auth\RouteServiceProvider;
use Bitaac\Auth\LaravelAuthServiceProvider;
use Bitaac\Core\Providers\AggregateServiceProvider;

class AuthServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        RouteServiceProvider::class,
        LaravelAuthServiceProvider::class,
    ];
}
