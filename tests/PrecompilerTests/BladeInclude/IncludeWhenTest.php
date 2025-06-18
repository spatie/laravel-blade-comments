<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for includeWhen', function () {
    $renderedView = view('includes.includeWhen.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded includeWhens', function () {
    config(['blade-comments.excludes.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeWhen.excludes')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
