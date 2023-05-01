<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add paths for extends', function() {
    $renderedView = view('extends.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
