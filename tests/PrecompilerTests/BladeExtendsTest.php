<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for extends', function () {
    $renderedView = view('extends.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
