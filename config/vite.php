<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Vite Manifest Path
    |--------------------------------------------------------------------------
    |
    | This option determines the path to the Vite manifest file. The Vite 
    | manifest is used to locate the generated assets during production.
    |
    */

    'manifest' => public_path('build/manifest.json'),

    /*
    |--------------------------------------------------------------------------
    | Vite Asset Versioning
    |--------------------------------------------------------------------------
    |
    | By default, versioning of assets is enabled in production. You can disable
    | it here if you don't want to version the assets when running in production.
    |
    */

    'versioning' => env('VITE_VERSIONING', true),
];
