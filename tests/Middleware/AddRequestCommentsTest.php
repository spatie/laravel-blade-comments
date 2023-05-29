<?php

use Illuminate\Support\Facades\Route;
use Spatie\BladePaths\Middleware\AddRequestComments;

it('will add the route to the response', function () {
    Route::view('test-route', 'includes.include.page')
        ->middleware(AddRequestComments::class);

    $response = $this
        ->get('test-route')
        ->content();

    $expectedStart = '<!-- View: includes.include.page -->'
        .PHP_EOL.'<!-- Route: \Illuminate\Routing\ViewController -->';

    expect($response)->toStartWith($expectedStart);
});
