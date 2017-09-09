<?php

namespace Bitaac\Guild;

use Illuminate\Http\Response;
use Bitaac\Guild\Http\Middleware;
use Bitaac\Core\Providers\AggregateServiceProvider;
use Bitaac\Guild\Exceptions\NotFoundGuildException;

class GuildServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Guild\Http\Controllers' => __DIR__.'/Http/routes.php',
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
        'can.edit'   => Middleware\CanEditMiddleware::class,
        'can.invite' => Middleware\CanInviteMiddleware::class,
        'has.owner'  => Middleware\HasOwnerMiddleware::class,
        'has.invite' => Middleware\HasInviteMiddleware::class,
        'guildwars.enabled' => Middleware\GuildwarsEnabledMiddleware::class,
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
            \Bitaac\Guild\Resources\Seeds\DatabaseSeeder::class
        );

        $this->exceptions->handle(NotFoundGuildException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });

        parent::register();
    }
}
