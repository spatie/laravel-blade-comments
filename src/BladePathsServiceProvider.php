<?php

namespace Spatie\BladePaths;

use Spatie\BladePaths\Exceptions\InvalidRenderer;
use Spatie\BladePaths\Renderers\Renderer;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BladePathsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-blade-paths')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        collect(config('blade-paths::renderers'))
            ->map(fn (string $rendererClass) => app($rendererClass))
            ->each(function (object $renderer) {
                if (! $renderer instanceof Renderer) {
                    throw InvalidRenderer::make($renderer);
                }
            })
            ->each(fn (Renderer $renderer) => $renderer->register());
    }
}
