<?php

use Spatie\BladeComments\BladeCommentsPrecompiler;
use Spatie\BladeComments\Commenters\BladeCommenters\BladeComponentCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\ExtendsCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\IncludeCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\LivewireComponentCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\LivewireDirectiveCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\SectionCommenter;
use Spatie\BladeComments\Commenters\RequestCommenters\RouteCommenter;
use Spatie\BladeComments\Commenters\RequestCommenters\ViewCommenter;
use Spatie\BladeComments\Http\Middleware\AddRequestComments;

return [
    'enable' => env('APP_DEBUG'),

    /**
     * Add a comment at the beginning and end of every blade
     * containing the relative path to the blade file.
     */
    'blade_paths' => true,

    /*
     * These classes provide regex for adding comments for
     * various Blade directives.
     */
    'blade_commenters' => [
        BladeComponentCommenter::class,
        ExtendsCommenter::class,
        IncludeCommenter::class,
        LivewireComponentCommenter::class,
        LivewireDirectiveCommenter::class,
        SectionCommenter::class,
    ],

    /*
     * These classes will add comments at the top of the response.
     */
    'request_commenters' => [
        ViewCommenter::class,
        RouteCommenter::class,
    ],

    /*
     * This middleware will add extra information about the request
     * to the start of a rendered HTML page.
     */
    'middleware' => [
        AddRequestComments::class,
    ],

    /*
     * This class is responsible for calling the registered Blade commenters.
     * In most cases, you don't need to modify this class.
     */
    'precompiler' => BladeCommentsPrecompiler::class,

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
