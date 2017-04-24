<?php

/*
|--------------------------------------------------------------------------
| Invidual guild routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/guild'], function ($router) {
    $router->get('/{guild}', 'Guild\ShowController@show');
    $router->get('/{guild}/invite', 'Guild\Member\InviteController@form')->middleware(['can.invite']);
    $router->post('/{guild}/invite', 'Guild\Member\InviteController@post')->middleware(['can.invite']);
    $router->get('/{guild}/join', 'Guild\Member\JoinController@form')->middleware(['auth', 'has.invite']);
    $router->post('/{guild}/join', 'Guild\Member\JoinController@post')->middleware(['auth', 'has.invite']);
    $router->get('/{guild}/cancel', 'Guild\Member\CancelController@form')->middleware(['auth', 'can.invite']);
    $router->post('/{guild}/cancel', 'Guild\Member\CancelController@post')->middleware(['auth', 'can.invite']);
    $router->get('/{guild}/disband', 'Guild\DisbandController@form')->middleware(['auth', 'has.owner']);
    $router->post('/{guild}/disband', 'Guild\DisbandController@post')->middleware(['auth', 'has.owner']);
    $router->get('/{guild}/edit', 'Guild\EditController@form')->middleware(['auth', 'can.edit']);
    $router->post('/{guild}/edit', 'Guild\EditController@post')->middleware(['auth', 'can.edit']);
    $router->get('/{guild}/leave', 'Guild\Member\LeaveController@form')->middleware(['auth']);
    $router->post('/{guild}/leave', 'Guild\Member\LeaveController@post')->middleware(['auth']);
    $router->get('/{guild}/ranks', 'Guild\RankController@form')->middleware(['auth', 'can.edit']);
    $router->post('/{guild}/ranks', 'Guild\RankController@post')->middleware(['auth', 'can.edit']);
    $router->get('/{guild}/members', 'Guild\Member\EditController@form')->middleware(['auth', 'can.edit']);
    $router->post('/{guild}/members', 'Guild\Member\EditController@post')->middleware(['auth', 'can.edit']);
    $router->get('/{guild}/edit/deletelogo', 'Guild\EditController@deletelogo')->middleware(['auth', 'can.edit']);
});

/*
|--------------------------------------------------------------------------
| Generic guilds routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/guilds'], function ($router) {
    $router->get('/{guild}/logo', 'ShowController@logo');
    $router->get('/', 'Guilds\GuildsController@index');
    $router->get('/create', 'Guilds\CreateController@form')->middleware(['auth']);
    $router->post('/create', 'Guilds\CreateController@post')->middleware(['auth']);
});

/*
|--------------------------------------------------------------------------
| Explicit bindings
|--------------------------------------------------------------------------
|
|
*/

$router->bind('guild', function ($guild) {
    $guild = app('guild')->where('name', str_replace('-', ' ',  $guild));

    if (! $guild->exists()) {
        throw new Bitaac\Guild\Exceptions\NotFoundGuildException;
    }

    return $guild->first();
});