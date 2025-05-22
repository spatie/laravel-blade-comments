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
