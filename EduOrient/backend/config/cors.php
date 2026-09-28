<?php

return [

    'paths' => ['api/*', 'broadcasting/auth', 'sanctum/csrf-cookie', 'storage/*'],

    'allowed_methods' => ['*'],

    /*
     | Origines autorisées (obligatoire si supports_credentials = true : pas de wildcard *).
     | Ajoutez d’autres origines via CORS_ALLOWED_ORIGINS dans .env (séparées par des virgules).
     */
    'allowed_origins' => array_values(array_filter(array_map(
        'trim',
        explode(',', env('CORS_ALLOWED_ORIGINS', 'http://localhost:5173,http://127.0.0.1:5173'))
    ))) ?: ['http://localhost:5173', 'http://127.0.0.1:5173', 'http://192.168.1.104:5173', 'http://192.168.1.104:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
