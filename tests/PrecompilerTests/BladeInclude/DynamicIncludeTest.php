<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

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
