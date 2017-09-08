<?php

/*
|--------------------------------------------------------------------------
| General Community Routes
|--------------------------------------------------------------------------
*/

$router->name('index')->get('/', 'IndexController@index');
$router->name('online')->get('/online', 'OnlineController@index');
$router->name('deaths')->get('/deaths', 'DeathsController@index');
$router->name('faq')->get('/faq', 'FaqController@index');
