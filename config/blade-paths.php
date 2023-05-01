<?php

return [
    'enable' => env('APP_ENV') === 'local',

    'renderers' => [
        Spatie\BladePaths\Renderers\BladeIncludeRenderer::class,
        Spatie\BladePaths\Renderers\BladeExtendsRenderer::class,
        Spatie\BladePaths\Renderers\LivewireViewsRenderer::class,
    ],
];
