<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Link used to display item images.
    |--------------------------------------------------------------------------
    |
    |
    */

    'images' => 'https://cdn.rawgit.com/pandaac-cdn/items/1076/{item_id}.gif',

    /*
    |--------------------------------------------------------------------------
    | Application SSL
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether the application should force a SSL (HTTPS)
    | mode across all pages and local URLs.
    |
    */

    'https' => env('APP_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Theme service provider
    |--------------------------------------------------------------------------
    | Currently available:
    |     Bitaac\Theme\RetroThemeServiceProvider::class
    |
    */

    'theme' => Bitaac\Theme\RetroThemeServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Admin Theme service provider
    |--------------------------------------------------------------------------
    | Currently available:
    |     Bitaac\ThemeAdmin\ThemeAdminServiceProvider::class
    |
    */

    'theme-admin' => Bitaac\ThemeAdmin\ThemeAdminServiceProvider::class,

];
