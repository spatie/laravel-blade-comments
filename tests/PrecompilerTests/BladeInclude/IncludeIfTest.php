<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

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
