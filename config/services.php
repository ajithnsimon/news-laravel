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
    'guardian' => [
        'api_key' => env('GUARDIAN_API_KEY'),
        'endpoint' => env('GUARDIAN_API_ENDPOINT', 'https://content.guardianapis.com'),
    ],
    'nyt' => [
        'api_key' => env('NYT_API_KEY'),
        'endpoint' => env('NYT_API_ENDPOINT', 'https://api.nytimes.com'),
    ],
    'newsapi' => [
        'api_key' => env('NEWS_API_KEY'),
        'endpoint' => env('NEWS_API_ENDPOINT', 'https://newsapi.org'),
    ],

];
