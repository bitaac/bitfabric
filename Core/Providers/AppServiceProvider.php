<?php

namespace Bitaac\Core\Providers;

use Auth;
use Validator;

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
