<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'shop' => env('SHOPIFY_STORE_DOMAIN'),

    'api_version' =>  env('SHOPIFY_API_VERSION', '2021-04'),

    'admin_api_password' => env('SHOPIFY_ADMIN_API_PASSWORD'),

    'database' => [
        'connection' => env('DB_SHOPIFY_CONNECTION'),
    ],
];
