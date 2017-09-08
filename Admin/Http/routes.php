<?php

/*
|--------------------------------------------------------------------------
| /admin routes
|--------------------------------------------------------------------------
*/

$router->name('admin')->get('/', 'AdminController');

$router->name('admin.payments')->get('/payments', 'Payments\PaymentsController@index');

$router->name('admin.products')->get('/products', 'Products\ProductsController@index');

$router->name('admin.products.create')->get('/products/create', 'Products\CreateController@form');
$router->post('/products/create', 'Products\CreateController@post');

$router->name('admin.product.edit')->get('/products/edit/{product}', 'Products\EditController@form');
$router->post('/products/edit/{product}', 'Products\EditController@post');

$router->name('admin.product.delete')->get('/products/delete/{product}', 'Products\DeleteController@form');
$router->post('/products/delete/{product}', 'Products\DeleteController@post');

$router->name('admin.boards')->get('/boards', 'Boards\BoardsController@index');

$router->name('admin.boards.create')->get('/boards/create', 'Boards\CreateController@form');
$router->post('/boards/create', 'Boards\CreateController@post');

$router->name('admin.board.edit')->get('/boards/edit/{board}', 'Boards\EditController@form');
$router->post('/boards/edit/{board}', 'Boards\EditController@post');

$router->name('admin.board.delete')->get('/boards/delete/{board}', 'Boards\DeleteController@form');
$router->post('/boards/delete/{board}', 'Boards\DeleteController@post');

$router->name('admin.accounts')->get('/accounts', 'Accounts\AccountsController@index');

$router->name('admin.account')->get('/account/{account}', 'Account\IndexController@index');
$router->post('/account/{account}', 'Account\IndexController@post');

$router->name('admin.account.edit')->get('/account/{account}/edit', 'Account\EditController@form');
$router->post('/account/{account}/edit', 'Account\EditController@post');

$router->name('admin.account.delete')->get('/account/{account}/delete', 'Account\DeleteController@form');
$router->post('/account/{account}/delete', 'Account\DeleteController@post');

$router->name('admin.account.impersonate')->get('/account/{account}/impersonate', 'Account\ImpersonationController@impersonate');
$router->name('admin.account.impersonate.stop')->get('/account/{account}/stopImpersonating', 'Account\ImpersonationController@stopImpersonating');

$router->name('admin.characters')->get('/characters', 'Characters\CharactersController@index');


/*
|--------------------------------------------------------------------------
| Explicit bindings
|--------------------------------------------------------------------------
*/

$router->model('account', Bitaac\Contracts\Account::class);
