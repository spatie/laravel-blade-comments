<?php

namespace Spatie\BladePaths;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
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

    public function packageBooted(): void
    {
        if (! config('blade-paths.enable')) {
            return;
        }

        $this
            ->registerMiddleware()
            ->registerPrecompilers();
    }

    protected function registerPrecompilers(): self
    {
        collect(config('blade-paths.precompilers'))
            ->each(function ($precompiler) {
                Blade::precompiler(fn (string $string) => $precompiler::execute($string));
            });

        return $this;
    }

    protected function registerMiddleware(): self
    {
        $kernel = resolve(Kernel::class);

        collect(config('blade-paths.middleware'))
            ->each(function ($middleware) use ($kernel) {
                $kernel->appendMiddlewareToGroup('web', $middleware);
            });

        return $this;
    }
}
