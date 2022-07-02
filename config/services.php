<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '452758216676879', //Facebook API
        'client_secret' => '9c656d7d69c2c98646bec91031de7467', //Facebook Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
     ],

     'google' => [
        'client_id' => '799913917514-n40o0aoukusf4bfkqfiae61rq9ep8eee.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/login/google/callback',
    ],
];
