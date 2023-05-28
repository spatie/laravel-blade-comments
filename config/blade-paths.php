<?php

return [
    'enable' => env('APP_ENV') !== 'production',

    'middleware' => [
        Spatie\BladePaths\Middleware\AddDebugInfo::class,
    ],

    'precompilers' => [
        Spatie\BladePaths\Precompilers\BladePathsPrecompiler::class,
    ],
];
