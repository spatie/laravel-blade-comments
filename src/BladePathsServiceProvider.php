<?php

namespace Spatie\BladePaths;

use Illuminate\Contracts\Http\Kernel;
use Spatie\BladePaths\Exceptions\InvalidRenderer;
use Spatie\BladePaths\Middleware\AddCurrentViewComment;
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
        if (! config('blade-paths.enable')) {
            return;
        }

        $this->registerRenderers();
        $this->registerMiddleware();
    }

    protected function registerRenderers(): void
    {
        collect(config('blade-paths.renderers'))
            ->map(fn (string $rendererClass) => app($rendererClass))
            ->each(function (object $renderer) {
                if (! $renderer instanceof Renderer) {
                    throw InvalidRenderer::make($renderer);
                }
            })
            ->each(fn (Renderer $renderer) => $renderer->register());
    }

    protected function registerMiddleware(): void
    {
        $kernel = resolve(Kernel::class);

        collect(config('blade-paths.middleware'))
            ->each(function ($middleware) use ($kernel) {
                $kernel->appendMiddlewareToGroup('web', $middleware);
            });
    }
}
