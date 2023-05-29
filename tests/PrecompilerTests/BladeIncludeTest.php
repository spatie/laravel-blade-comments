<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for includes', function () {
    $renderedView = view('includes.include.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeIf', function () {
    $renderedView = view('includes.includeIf.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeWhen', function () {
    $renderedView = view('includes.includeWhen.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeUnless', function () {
    $renderedView = view('includes.includeUnless.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
