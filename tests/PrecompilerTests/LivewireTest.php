<?php

use function Spatie\Snapshots\assertMatchesHtmlSnapshot;

it('will add comments for Livewire components', function () {
    $renderedView = view('livewire.page')->render();

    $renderedView = $this->preparedLivewireHtmlForSnapshot($renderedView);

    assertMatchesHtmlSnapshot($renderedView);
});

// it('will add comments for Livewire directives', function () {
//    $renderedView = view('livewire.page')->render();
//
//    $renderedView = $this->preparedLivewireHtmlForSnapshot($renderedView);
//
//    assertMatchesHtmlSnapshot($renderedView);
// });
