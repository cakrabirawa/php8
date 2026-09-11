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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'api_email' => [
        'url' => env('API_EMAIL_URL', 'https://merpati-gml.gramedia.id/api/v1/send-email'),
        'token' => env('API_EMAIL_TOKEN'),
        'to' => env('API_EMAIL_TO'),
    ],

    'api_wa' => [
        'url' => env('API_WA_URL', 'https://merpati-wa.gramedia.id/api/v1/wa/sendx'),
        'to' => env('API_WA_TO'),
    ],
    'd365' => [
        'client_id' => env('D365_CLIENT_ID'),
        'client_secret' => env('D365_CLIENT_SECRET'),
        'resource_url' => env('D365_RESOURCE_URL'),
        'grant_type' => env('D365_GRANT_TYPE'),
        'token_url' => env('D365_TOKEN_URL'),
        'update_failed_to_post_url' => env('D365_UPDATE_FAILED_TO_POST_URL'),
    ],
];
