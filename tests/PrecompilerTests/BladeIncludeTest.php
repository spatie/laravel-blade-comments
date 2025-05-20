<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for includes', function () {
    $renderedView = view('includes.include.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includes with data', function () {
    $renderedView = view('includes.include.page-with-data')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

// todo - fails
 it('will add comments for includes with data - 2', function () {
     $renderedView = view('includes.include.page-with-data-2')->render();

     assertMatchesHtmlSnapshot($renderedView);
 });

it('will add comments for includes with data - 3', function () {
    $renderedView = view('includes.include.page-with-data-3')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includes with data - 4', function () {
    $renderedView = view('includes.include.page-with-data-4')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded includes', function () {
    config(['blade-comments.excludes.includes' => ['includes.exclude']]);

    $renderedView = view('includes.include.excludes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeIf', function () {
    $renderedView = view('includes.includeIf.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeIf with data', function () {
    $renderedView = view('includes.includeIf.page-with-data')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded includeIfs', function () {
    config(['blade-comments.excludes.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeIf.excludes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeWhen', function () {
    $renderedView = view('includes.includeWhen.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded includeWhens', function () {
    config(['blade-comments.excludes.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeWhen.excludes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeUnless', function () {
    $renderedView = view('includes.includeUnless.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded includeUnless', function () {
    config(['blade-comments.excludes.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeUnless.excludes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});


# Dynamic includes
it('will add comments for dynamic includes', function () {
    $renderedView = view('includes.include.dynamic.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for dynamic includes in loop iterations', function () {
    $renderedView = view('includes.include.dynamic.page-loop')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for dynamic includes with ternary operators', function () {
    $renderedView = view('includes.include.dynamic.page-ternary-includes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for dynamic includes with complex expressions', function () {
    $renderedView = view('includes.include.dynamic.page-complex-expressions')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
