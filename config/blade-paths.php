<?php

return [
    'enable' => env('APP_ENV') !== 'production',

    'middleware' => [
        Spatie\BladePaths\Middleware\AddCurrentViewComment::class,
    ],

    'precompilers' => [
        Spatie\BladePaths\Precompiler\BladePathsPrecompiler::class,
    ],
];
