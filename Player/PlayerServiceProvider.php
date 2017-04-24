<?php

namespace Bitaac\Player;

use Illuminate\Http\Response;
use Bitaac\Player\Http\Middleware;
use Bitaac\Core\Providers\AggregateServiceProvider;
use Bitaac\Player\Exceptions\NotFoundPlayerException;

class PlayerServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Player\Http\Controllers' => __DIR__.'/Http/routes.php',
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
        'character.exists' => Middleware\CharacterExistsMiddleware::class,
        'owns.character'   => Middleware\OwnsCharacterMiddleware::class,
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['seed.handler']->register(
            \Bitaac\Player\Resources\Seeds\DatabaseSeeder::class
        );

        $this->exceptions->handle(NotFoundPlayerException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });

        parent::register();
    }
}
