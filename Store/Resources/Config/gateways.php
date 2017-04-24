<?php

return [

    /*
    |--------------------------------------------------------------------------
    | omnipay/paypal settings
    |--------------------------------------------------------------------------
    |
    |
    */

    'paypal' => [
        'enabled'  => true,
        'sandbox' => true,
        'currency' => 'USD',
        'presentable' => 'Paypal',
        'omnipay' => 'PayPal_Rest',
        'description' => 'Bitaac Donation Points',
        'client' => env('PAYPAL_CLIENT', 'XXX'),
        'secret' => env('PAYPAL_SECRET', 'XXX'),

        'offers' => [
            '10.00' => 250,
            '15.00' => 350,
            '20.00' => 450,
        ],
    ],

];
