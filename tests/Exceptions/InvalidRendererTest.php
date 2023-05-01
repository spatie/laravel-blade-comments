<?php

use Spatie\BladePaths\Exceptions\InvalidRenderer;

it('will throw an exception when an invalid renderer is in the config file', function () {
    config()->set('blade-paths.renderers', [InvalidRenderer::class]);

    $this->rerunServiceProvider();
})->throws(InvalidRenderer::class);
