<?php

namespace Bitaac\Forum;

use Bitaac\Forum\Exceptions;
use Illuminate\Http\Response;
use Bitaac\Forum\Http\Middleware;
use Bitaac\Core\Providers\AggregateServiceProvider;

class ForumServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Forum\Http\Controllers' => __DIR__.'/Http/routes.php',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'not.locked' => Middleware\NotLockedMiddleware::class,
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
     * Holds all contracts and models we want to bind.
     *
     * @var array
     */
    protected $bindings = [
        'forum.post'  => [\Bitaac\Contracts\ForumPost::class  => \Bitaac\Forum\Models\ForumPost::class],
        'forum.board' => [\Bitaac\Contracts\ForumBoard::class => \Bitaac\Forum\Models\Board::class],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['seed.handler']->register(
            \Bitaac\Forum\Resources\Seeds\DatabaseSeeder::class
        );

        $this->exceptions->handle(Exceptions\NotFoundBoardException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });

        $this->exceptions->handle(Exceptions\NotFoundThreadException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });

        parent::register();
    }
}
