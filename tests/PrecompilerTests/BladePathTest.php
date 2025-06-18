<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for blade components', function () {
    config()->set('blade-comments.blade_paths', true);
    $renderedView = view('bladeComponent.nested-complex')->render();

    assertMatchesHtmlSnapshot($renderedView);
});

it('will will throw exceptions if paths are not present', function () {
    config()->set('blade-comments.blade_paths', true);
    Blade::component('anonymous-blade-component.anonymous', 'anonymous-component');

    $renderedView = view('anonymous-blade-component.page')->render();

    assertMatchesHtmlSnapshot($renderedView);
});
