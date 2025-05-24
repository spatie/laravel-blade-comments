<?php

namespace Tests\Middleware;

use Illuminate\Support\Facades\Route;
use Spatie\BladeComments\Http\Middleware\AddRequestComments;

describe('Comment Generation', function() {

    it('adds view and route comments to HTML responses', function() {

        Route::view('test-route', 'includes.include.page')
            ->middleware(AddRequestComments::class);

        $response = $this->get('test-route')->content();

        expect($response)
            ->toStartWith('<!-- View: includes.include.page -->')
            ->toContain('<!-- Route: \Illuminate\Routing\ViewController -->');
    });

    it('handles closure routes', function() {
        Route::get('closure-route', fn() => view('includes.include.page'))
            ->middleware(AddRequestComments::class);

        $response = $this->get('closure-route')->content();

        expect($response)
            ->toStartWith('<!-- View: includes.include.page -->')
            ->not->toContain('<!-- Route: \Illuminate\Routing\ViewController -->');
    });
});

describe('Response Types', function() {

    it('ignores non-HTML responses', function() {
        Route::get('route-json', fn() => response()->json(['test' => true]))
            ->middleware(AddRequestComments::class);

        $response = $this->get('route-json');
        expect($response->headers->get('Content-Type'))->not->toContain('html');
        expect($response->content())->not->toContain('<!--');
    });


    /**
     * This test verifies that the middleware properly handles responses with explicitly
     * set Content-Type headers (including charset information), rather than relying solely
     * on Laravel's automatic Content-Type determination.
     */
    it('handles responses with different content types', function() {
        Route::get('test-route', function() {
            return response(view('includes.include.page'))
                ->header('Content-Type', 'text/html; charset=UTF-8');
        })->middleware(AddRequestComments::class);

        $response = $this->get('test-route');

        expect($response->content())->toContain('<!-- View:');
    });
});

describe('Error Handling', function() {

    /*
     * This test verifies the middleware's resilience when handling responses
     * where the original property exists but doesn't have the expected view interface.
     *
     * Real-world scenarios where this might occur:
     * - Custom response generators from third-party packages
     * - Integration with non-Laravel components that generate HTML
     * - Custom middleware that replaces response properties
     * - Responses created manually without using the standard view rendering
     */
    it('gracefully handles responses without valid view objects', function() {
        Route::get('custom-response-route', function() {
            $response = new \Illuminate\Http\Response('Custom HTML content');
            $response->original = new \stdClass(); // Object without name() method
            $response->header('Content-Type', 'text/html');
            return $response;
        })->middleware(AddRequestComments::class);

        $response = $this->get('custom-response-route');

        // The middleware should not add view comments but preserve the content
        expect($response->content())
            ->toBe('Custom HTML content')
            ->not->toContain('<!-- View:');
    });

    /**
     * When returning raw string content, no comments should be added
     * because the response's 'original' property is a string, not an object
     */
    it('skips adding comments to raw string responses', function() {
        Route::get('test-route', function() {
            return response('Raw content')->header('Content-Type', 'text/html');
        })->middleware(AddRequestComments::class);

        $response = $this->get('test-route');

        expect($response->content())->not->toContain('<!--');
    });

});

describe('Comment Configuration', function() {
    it('respects custom commenters configuration', function() {
        config([
            'blade-comments.enable' => true,
            'blade-comments.request_commenters' => [
                \Spatie\BladeComments\Commenters\RequestCommenters\ViewCommenter::class,
            ]
        ]);

        Route::view('test-route', 'includes.include.page')
            ->middleware(AddRequestComments::class);

        $response = $this->get('test-route')->content();

        expect($response)
            ->toContain('<!-- View:')
            ->not->toContain('<!-- Route:');
    });
});
