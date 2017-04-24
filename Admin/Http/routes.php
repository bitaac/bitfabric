<?php

/*
|--------------------------------------------------------------------------
| /admin Routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function ($router) {
    $router->get('/', 'AdminController');
    $router->get('/products', 'Products\ProductsController@index');
    $router->get('/products/create', 'Products\CreateController@form');
    $router->post('/products/create', 'Products\CreateController@post');
    $router->post('/products/edit/{product}', 'Products\EditController@post');
    $router->get('/products/edit/{product}', 'Products\EditController@form');
    $router->post('/products/delete/{product}', 'Products\DeleteController@post');
    $router->get('/products/delete/{product}', 'Products\DeleteController@form');
    $router->get('/payments', 'Payments\PaymentsController@index');
    $router->get('/boards', 'Boards\BoardsController@index');
    $router->get('/boards/create', 'Boards\CreateController@form');
    $router->post('/boards/create', 'Boards\CreateController@post');
    $router->get('/boards/edit/{board}', 'Boards\EditController@form');
    $router->post('/boards/edit/{board}', 'Boards\EditController@post');
    $router->get('/boards/delete/{board}', 'Boards\DeleteController@form');
    $router->post('/boards/delete/{board}', 'Boards\DeleteController@post');
});
