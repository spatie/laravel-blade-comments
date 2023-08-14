<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for includes', function () {
    $renderedView = view('includes.include.page')->render();

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
