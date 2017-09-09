<?php

namespace Bitaac\Account;

use Bitaac\Account\Http\Middleware;
use Bitaac\Account\RouteServiceProvider;
use Bitaac\Core\Providers\AggregateServiceProvider;

class AccountServiceProvider extends AggregateServiceProvider
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
        'email.update' => Middleware\EmailUpdateMiddleware::class,
        'change.email.enabled' => Middleware\ChangeEmailEnabledMiddleware::class,
        'delete.character.enabled' => Middleware\DeleteCharacterEnabledMiddleware::class,
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
        ], 'bitaac:config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['seed.handler']->register(
            \Bitaac\Account\Resources\Seeds\DatabaseSeeder::class
        );

        parent::register();
    }
}
