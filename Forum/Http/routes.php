<?php

/*
|--------------------------------------------------------------------------
| /forum routes
|--------------------------------------------------------------------------
|
|
*/

$router->group(['prefix' => '/forum'], function ($router) {
    $router->get('/', 'ForumController@index');
    $router->get('/{board}', 'Board\ShowController@index');
    $router->get('/{board}/create', 'Thread\CreateController@form')->middleware('auth');
    $router->post('/{board}/create', 'Thread\CreateController@post')->middleware('auth');
    $router->get('/{board}/{thread}', 'Thread\ShowController@index');
    $router->get('/{board}/{thread}/lock', 'Thread\LockController@form')->middleware(['auth', 'admin']);
    $router->post('/{board}/{thread}/lock', 'Thread\LockController@post')->middleware(['auth', 'admin']);
    $router->get('/{board}/{thread}/unlock', 'Thread\UnlockController@form')->middleware(['auth', 'admin']);
    $router->post('/{board}/{thread}/unlock', 'Thread\UnlockController@post')->middleware(['auth', 'admin']);
    $router->get('/{board}/{thread}/delete', 'Thread\DeleteController@form')->middleware(['auth', 'admin']);
    $router->post('/{board}/{thread}/delete', 'Thread\DeleteController@post')->middleware(['auth', 'admin']);
    $router->get('/{board}/{thread}/reply', 'Thread\ReplyController@index')->middleware(['auth', 'not.locked']);
    $router->post('/{board}/{thread}/reply', 'Thread\ReplyController@post')->middleware(['auth', 'not.locked']);
});

/*
|--------------------------------------------------------------------------
| Explicit bindings
|--------------------------------------------------------------------------
|
|
*/

$router->bind('board', function ($board) {
    $board = app('forum.board')->where('title', str_replace('-', ' ', $board));

    if (! $board->exists()) {
        throw new Bitaac\Forum\Exceptions\NotFoundBoardException;
    }

    return $board->first();
});

$router->bind('thread', function ($board) {
    $board = app('forum.post')->where('title', str_replace('-', ' ', $board));

    if (! $board->exists()) {
        throw new Bitaac\Forum\Exceptions\NotFoundThreadException;
    }

    return $board->first();
});



