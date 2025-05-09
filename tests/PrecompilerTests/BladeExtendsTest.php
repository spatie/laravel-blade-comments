<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for extends', function () {
    $renderedView = view('extends.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter excluded sections', function () {
    config(['blade-comments.excludes.sections' => ['excluded-section']]);
    $renderedView = view('extends.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
    expect($renderedView)->not->toContain('<!-- Start section: excluded-section -->');
});

it('will add comments for extends with invalid excluded sections', function () {
    config(['blade-comments.excludes.sections' => ['exclude-section-that-does-not-exist']]);
    $renderedView = view('extends.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
    expect($renderedView)->toContain('<!-- Start section: excluded-section -->');
});
