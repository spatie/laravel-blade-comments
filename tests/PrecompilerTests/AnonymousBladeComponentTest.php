<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for anonymous Blade components', function () {
    $renderedView = view('anonymousBladeComponent.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
})->skip();
