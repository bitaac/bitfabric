<?php

/*
|--------------------------------------------------------------------------
| /register & /login routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->name('login')->get('/login', 'Auth\LoginController@form');
$router->post('/login', 'Auth\LoginController@post');
$router->name('register')->get('/register', 'Auth\RegisterController@form');
$router->post('/register', 'Auth\RegisterController@post');

/*
|--------------------------------------------------------------------------
| /account routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/account', 'middleware' => ['auth', 'email.update']], function ($router) {
    $router->get('/', 'AccountController@index');
    $router->get('/logout', 'AccountController@logout');
    $router->get('/password', 'Change\PasswordController@form');
    $router->post('/password', 'Change\PasswordController@post');
    $router->get('/email', 'Change\EmailController@form');
    $router->post('/email', 'Change\EmailController@post');
    $router->get('/character', 'Character\CreateController@form');
    $router->post('/character', 'Character\CreateController@post');
    $router->get('/character/delete', 'Character\DeleteController@form');
    $router->post('/character/delete', 'Character\DeleteController@post');
    $router->get('/undelete/{player}', 'Character\UndeleteController@form')->middleware(['character.exists', 'owns.character']);
    $router->post('/undelete/{player}', 'Character\UndeleteController@post')->middleware(['character.exists', 'owns.character']);
    $router->get('/authentication', 'Authentication\AuthenticationController@form');
    $router->post('/authentication', 'Authentication\AuthenticationController@post');
});
