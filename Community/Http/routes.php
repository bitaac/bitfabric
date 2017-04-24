<?php

/*
|--------------------------------------------------------------------------
| General Community Routes
|--------------------------------------------------------------------------
|
| ...
|
*/

$router->get('/', 'WelcomeController@index');
$router->get('/online', 'OnlineController@index');
$router->get('/deaths', 'DeathsController@index');
$router->get('/faq', 'FaqController@index');
