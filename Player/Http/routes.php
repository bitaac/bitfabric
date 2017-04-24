<?php

/*
|--------------------------------------------------------------------------
| /character routes
|--------------------------------------------------------------------------
|
|
*/

$router->group(['prefix' => '/character'], function ($router) {
    $router->get('/', 'SearchController@form');
    $router->post('/', 'SearchController@post');
    $router->get('/{player}', 'CharacterController@index');
});

/*
|--------------------------------------------------------------------------
| Explicit bindings
|--------------------------------------------------------------------------
|
|
*/

$router->bind('player', function ($name) {
    $player = app('player')->where('name', str_replace('-', ' ', $name));

    if (! $player->exists()) {
        throw new Bitaac\Player\Exceptions\NotFoundPlayerException;
    }

    return $player->first();
});
