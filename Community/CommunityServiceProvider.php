<?php

namespace Bitaac\Community;

use Bitaac\Core\Providers\AggregateServiceProvider;

class CommunityServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider routes file paths.
     *
     * @var array
     */
    protected $routes = [
        'Bitaac\Community\Http\Controllers' => __DIR__.'/Http/routes.php',
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

