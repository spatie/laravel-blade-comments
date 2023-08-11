<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for includes', function () {
    $renderedView = view('includes.include.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter blacklisted includes', function () {
    config(['blade-comments.blacklist.includes' => ['includes.exclude']]);

    $renderedView = view('includes.include.blacklist')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeIf', function () {
    $renderedView = view('includes.includeIf.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter blacklisted includeIfs', function () {
    config(['blade-comments.blacklist.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeIf.blacklist')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeWhen', function () {
    $renderedView = view('includes.includeWhen.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter blacklisted includeWhens', function () {
    config(['blade-comments.blacklist.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeWhen.blacklist')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for includeUnless', function () {
    $renderedView = view('includes.includeUnless.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('should filter blacklisted includeUnless', function () {
    config(['blade-comments.blacklist.includes' => ['includes.exclude']]);
    $renderedView = view('includes.includeUnless.blacklist')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
