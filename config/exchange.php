<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AIX Exchange Mail Sender
    |--------------------------------------------------------------------------
    |
    | Exchange transaction emails are sent from this address so they stay
    | separate from the investment platform mail identity.
    |
    */

    'mail' => [
        'from' => [
            'address' => env('EXCHANGE_MAIL_FROM_ADDRESS', 'noreply@aixexchange.top'),
            'name' => env('EXCHANGE_MAIL_FROM_NAME', 'AIX Exchange'),
        ],
    ],

];
