<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for blade components', function () {
    $renderedView = view('bladeComponent.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
