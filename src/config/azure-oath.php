<?php

return [
    'routes' => [
        'middleware' => 'web',
        'login' => 'login/microsoft',
        'callback' => 'login/microsoft/callback',
    ],
    'credentials' => [
        'client_id' => env('AZURE_AD_CLIENT_ID', ''),
        'client_secret' => env('AZURE_AD_CLIENT_SECRET', ''),
        'redirect' => '/login/microsoft/callback'
    ],
    'user_email_address' => 'user_email_address',
    'redirect_on_login' => '/home',
    'user_class' => '\\App\\User'
];
