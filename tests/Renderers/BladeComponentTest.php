<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add paths for blade components', function () {
    $renderedView = view('bladeComponent.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
