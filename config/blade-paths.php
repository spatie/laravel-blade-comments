<?php

return [
    'enable' => env('APP_ENV') !== 'production',

    'commenters' => [
        Spatie\BladePaths\Precompilers\BladeCommenters\BladeStartComponentCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\BlandeEndComponentCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\ExtendsCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\IncludeCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\IncludeIfCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\IncludeWhenCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\LivewireComponentCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\LivewireDirectiveCommenter::class,
        Spatie\BladePaths\Precompilers\BladeCommenters\SectionCommenter::class,
    ],

    'middleware' => [
        Spatie\BladePaths\Middleware\AddDebugInfo::class,
    ],

    'precompilers' => [
        Spatie\BladePaths\Precompilers\BladeCommentsPrecompiler::class,
    ],
];
