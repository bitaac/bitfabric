<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable or disable two factor auth
    |--------------------------------------------------------------------------
    */

    'two-factor' => false,

    /*
    |--------------------------------------------------------------------------
    | Max characters per account
    |--------------------------------------------------------------------------
    */

    'max-characters' => 10,

    /*
    |--------------------------------------------------------------------------
    | Account change email
    |--------------------------------------------------------------------------
    */

    // Disabled / Enable ability to change email.
    'change-email-enabled' => true,

    // Time in seconds when the actual email change will take place.
    'change-email-time' => 0,

    /*
    |--------------------------------------------------------------------------
    | Account Character deletion
    |--------------------------------------------------------------------------
    */

    // Disabled / Enable ability to delete character.
    'delete-character-enabled' => true,

    // Time in seconds when the actual character deletion will take place.
    'delete-character-time' => 1 * 60 * 60,

];
