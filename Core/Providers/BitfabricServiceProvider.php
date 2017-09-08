<?php

namespace Bitaac\Core\Providers;

use Bitaac\Contracts;
use Illuminate\Http\Response;
use Bitaac\Auth\AuthServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Bitaac\Admin\AdminServiceProvider;
use Bitaac\Guild\GuildServiceProvider;
use Bitaac\Store\StoreServiceProvider;
use Bitaac\Forum\ForumServiceProvider;
use Bitaac\Player\PlayerServiceProvider;
use Bitaac\Account\AccountServiceProvider;
use Bitaac\Highscore\HighscoreServiceProvider;
use Bitaac\Community\CommunityServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BitfabricServiceProvider extends AggregateServiceProvider
{
    /**
     * Holds all service providers we want to register.
     *
     * @var array
     */
    protected $providers = [
        AppServiceProvider::class,
        AuthServiceProvider::class,
        SHAHashServiceProvider::class,
        PlayerServiceProvider::class,
        AccountServiceProvider::class,
        ForumServiceProvider::class,
        CommunityServiceProvider::class,
        HighscoreServiceProvider::class,
        StoreServiceProvider::class,
        GuildServiceProvider::class,
        AdminServiceProvider::class,
    ];

    /**
     * The binding class names & alias.
     *
     * @var array
     */
    protected $bindings = [
        'account'        => [Contracts\Account::class   => \Bitaac\Account\Models\Account::class],
        'player'         => [Contracts\Player::class    => \Bitaac\Player\Models\Player::class],
        'death'          => [Contracts\Death::class     => \Bitaac\Death\Models\Death::class],
        'online'         => [Contracts\Online::class    => \Bitaac\Player\Models\Online::class],
        'highscore'      => [Contracts\Highscore::class => \Bitaac\Highscore\Models\Highscore::class],
        'player.storage' => [Contracts\PlayerStorage::class => \Bitaac\Player\Models\PlayerStorage::class],

        // Guild
        'guild'        => [Contracts\Guild::class       => \Bitaac\Guild\Models\Guild::class],
        'guild.member' => [Contracts\GuildMember::class => \Bitaac\Guild\Models\GuildMember::class],
        'guild.rank'   => [Contracts\GuildRank::class   => \Bitaac\Guild\Models\GuildRank::class],
        'guild.invite' => [Contracts\GuildInvite::class => \Bitaac\Guild\Models\GuildInvite::class],
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
        $aliasloader = AliasLoader::getInstance();
        $aliasloader->alias('Omnipay', \Barryvdh\Omnipay\Facade::class);

        if (config('bitaac.account.two-factor', false)) {
            $this->app->register(\PragmaRX\Google2FA\Vendor\Laravel\ServiceProvider::class);
            $aliasloader->alias('Google2FA', \PragmaRX\Google2FA\Vendor\Laravel\Facade::class);
        }

        //$this->app->register(\Barryvdh\Omnipay\ServiceProvider::class);
        $this->app->register(\Seedster\SeedsterServiceProvider::class);
        
        $this->app->booted(function () {
            $this->app->register(config('bitaac.app.theme', \Bitaac\ThemeDefault\ThemeDefaultServiceProvider::class));
            $this->app->register(config('bitaac.app.theme-admin', \Bitaac\ThemeAdmin\ThemeAdminServiceProvider::class));
        });

        $this->exceptions->handle(ModelNotFoundException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });

        $this->exceptions->handle(NotFoundHttpException::class, function ($e) {
            return new Response(view('bitaac::errors.404'), 404);
        });

        parent::register();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $kernel = app('Illuminate\Contracts\Http\Kernel');
        $kernel->prependMiddleware(\Bitaac\Core\Http\Middleware\DeleteCharacterMiddleware::class);
        $kernel->pushMiddleware(\Bitaac\Core\Http\Middleware\DeleteCharacterMiddleware::class);

        if (config('bitaac.app.https')) {
            $this->app['url']->forceSchema('https');
        }

        $this->publishes([
            __DIR__.'/../Config' => config_path('bitaac'),
        ], 'bitaac:config');
    }
}
