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
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],


    'groq' => [
        'api_key' => env('GROQ_API_KEY'),
        'model' => env('GROQ_MODEL', 'llama-3.1-8b-instant'),
        'endpoint' => env('GROQ_ENDPOINT', 'https://api.groq.com/openai/v1/chat/completions'),
        'matching_timeout' => env('GROQ_MATCHING_TIMEOUT', 20),
        'matching_sleep_in_loop' => env('GROQ_MATCHING_SLEEP_IN_LOOP', false),
        'matching_min_score' => env('GROQ_MATCHING_MIN_SCORE', 15),
    ],

    'huggingface' => [
        'api_key' => env('HUGGINGFACE_API_KEY'),
        'model' => env('HUGGINGFACE_MODEL', 'mistralai/Mistral-7B-Instruct-v0.2'),
        'endpoint' => env('HUGGINGFACE_ENDPOINT', 'https://api-inference.huggingface.co/models/mistralai/Mistral-7B-Instruct-v0.2'),
        'matching_timeout' => env('HUGGINGFACE_MATCHING_TIMEOUT', 30),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
