<?php

namespace Bitaac\Core\Providers;

use Auth;
use Validator;
use Bitaac\Core\Console\Commands;

class AppServiceProvider extends \App\Providers\AppServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        view()->composer('*', function ($view) {
            $view->with('account', auth()->user());
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeAdminCommand::class,
            ]);
        }

        include __DIR__.'/../validator.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
