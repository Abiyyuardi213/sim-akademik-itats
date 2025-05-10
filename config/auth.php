<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users', // Update this to your custom provider
        ],
    ],

    'providers' => [
        'users' => [  // Add a new provider for Pengguna
            'driver' => 'eloquent',
            'model' => App\Models\Pengguna::class, // Point to your custom Pengguna model
        ],
    ],

    'passwords' => [
        'pengguna' => [  // Update this to match your provider name
            'provider' => 'pengguna',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
