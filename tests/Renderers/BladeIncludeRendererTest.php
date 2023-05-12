<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add paths for includes', function () {
    $renderedView = view('includes.include.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add paths for includeIf', function () {
    $renderedView = view('includes.includeIf.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add paths for includeWhen', function () {
    $renderedView = view('includes.includeWhen.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add paths for includeUnless', function () {
    $renderedView = view('includes.includeUnless.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
