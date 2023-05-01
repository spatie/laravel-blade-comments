<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add paths for includes', function () {
    $renderedView = view('include.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
