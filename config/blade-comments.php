<?php

return [
    'enable' => env('APP_DEBUG'),

    /*
     * These classes provide regex for adding comments for
     * various Blade directives.
     */
    'blade_commenters' => [
        Spatie\BladeComments\Commenters\BladeCommenters\BladeComponentCommenter::class,
        Spatie\BladeComments\Commenters\BladeCommenters\ExtendsCommenter::class,
        Spatie\BladeComments\Commenters\BladeCommenters\IncludeCommenter::class,
        // todo
//        Spatie\BladeComments\Commenters\BladeCommenters\LivewireComponentCommenter::class,
//        Spatie\BladeComments\Commenters\BladeCommenters\LivewireDirectiveCommenter::class,
        Spatie\BladeComments\Commenters\BladeCommenters\SectionCommenter::class,
    ],

    /*
     * These classes will add comments at the top of the response.
     */
    'request_commenters' => [
        Spatie\BladeComments\Commenters\RequestCommenters\ViewCommenter::class,
        Spatie\BladeComments\Commenters\RequestCommenters\RouteCommenter::class,
    ],

    /*
     * This middleware will add extra information about the request
     * to the start of a rendered HTML page.
     */
    'middleware' => [
        Spatie\BladeComments\Http\Middleware\AddRequestComments::class,
    ],

    /*
     * This class is responsible for calling the registered Blade commenters.
     * In most cases, you don't need to modify this class.
     */
    'precompiler' => Spatie\BladeComments\BladeCommentsPrecompiler::class,

    'excludes' => [
        /**
         * Add includes you don't want to be affected by the package here.
         * For example:
         *  'styles.theme',
         *  'partials.sidebar',
         */
        'includes' => [

        ],

        /**
         * Add sections you don't want to be affected by the package here.
         * These sections will not have HTML comments added around @yield directives
         * For example:
         *  'header',
         *  'message',
         */
        'sections' => [

        ],
    ],
];
