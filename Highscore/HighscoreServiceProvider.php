<?php

namespace Bitaac\Highscore;

use Bitaac\Core\Providers\AggregateServiceProvider;

class HighscoreServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Highscore\Http\Controllers' => __DIR__.'/Http/routes.php',
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
}
