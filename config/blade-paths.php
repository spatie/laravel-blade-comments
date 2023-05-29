<?php

return [
    'enable' => env('APP_ENV') !== 'production',

    /*
     * These classes provide regex for adding comments for
     * various Blade directives.
     */
    'blade_commenters' => [
        \Spatie\BladePaths\Commenters\BladeCommenters\BladeStartComponentCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\BlandeEndComponentCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\ExtendsCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\IncludeCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\IncludeIfCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\IncludeWhenCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\LivewireComponentCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\LivewireDirectiveCommenter::class,
        \Spatie\BladePaths\Commenters\BladeCommenters\SectionCommenter::class,
    ],

    /**
     * These classes will add comments at the top of the response.
     */
    'request_commenters' => [
        \Spatie\BladePaths\Commenters\RequestCommenters\ViewCommenter::class,
        \Spatie\BladePaths\Commenters\RequestCommenters\RouteCommenter::class,
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
