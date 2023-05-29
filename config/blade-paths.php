<?php

return [
    'enable' => env('APP_ENV') !== 'production',

    /*
     * These classes provide regex for adding comments for
     * various Blade directives.
     */
    'blade_commenters' => [
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

    /**
     * These classes will add comments at the top of the response.
     */
    'request_commenters' => [
        Spatie\BladePaths\Middleware\RequestCommenters\ViewCommenter::class,
        Spatie\BladePaths\Middleware\RequestCommenters\RouteCommenter::class,
    ],

    /*
     * This middleware will add extra information about the request
     * to the start of a rendered HTML page
     */
    'middleware' => [
        Spatie\BladePaths\Middleware\AddRequestComments::class,
    ],

    /*
     * This class is responsible for calling the registered Blade commenters.
     * In most case, you don't need to modify this class.
     */
    'precompilers' => [
        Spatie\BladePaths\Precompilers\BladeCommentsPrecompiler::class,
    ],
];
