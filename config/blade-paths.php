<?php

return [
    'enable' => env('APP_ENV') !== 'production',

    'renderers' => [
        Spatie\BladePaths\Renderers\BladeIncludeRenderer::class,
        Spatie\BladePaths\Renderers\BladeExtendsRenderer::class,
        Spatie\BladePaths\Renderers\BladeComponentRenderer::class,
        Spatie\BladePaths\Renderers\LivewireComponentRenderer::class,
    ],

    'middleware' => [
        Spatie\BladePaths\Middleware\AddCurrentViewComment::class,
    ]
];
