<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for blade components', function () {
    $renderedView = view('bladeComponent.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will add comments for anonymous Blade components', function () {


    Blade::component('anonymous-blade-component.anonymous', 'anonymous-component');

    $renderedView = view('anonymous-blade-component.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
