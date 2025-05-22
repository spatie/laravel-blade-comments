<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for includeUnless', function () {
    $renderedView = view('includes.includeUnless.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded includeUnless', function () {
    config(['blade-comments.excludes.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeUnless.excludes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
