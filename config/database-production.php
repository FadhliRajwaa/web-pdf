<?php

return [
    'default' => 'pgsql_production',
    
    'connections' => [
        'pgsql_production' => [
            'driver' => 'pgsql',
            'host' => env('PRODUCTION_DB_HOST'),
            'port' => env('PRODUCTION_DB_PORT', '5432'),
            'database' => env('PRODUCTION_DB_DATABASE'),
            'username' => env('PRODUCTION_DB_USERNAME'),
            'password' => env('PRODUCTION_DB_PASSWORD'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],
    ],
];
