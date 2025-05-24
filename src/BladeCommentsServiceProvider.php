<?php

namespace Spatie\BladeComments;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BladeCommentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-blade-comments')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        if (! config('blade-comments.enable')) {
            return;
        };

        $this
            ->registerMiddleware()
            ->registerPrecompiler();
    }

    protected function registerPrecompiler(): self
    {
        $precompilerClass = config('blade-comments.precompiler');

        Blade::prepareStringsForCompilationUsing(fn (string $string) => $precompilerClass::execute($string));

        return $this;
    }

    protected function registerMiddleware(): self
    {
        $kernel = resolve(Kernel::class);

        collect(config('blade-comments.middleware'))
            ->each(function ($middleware) use ($kernel) {
                $kernel->appendMiddlewareToGroup('web', $middleware);
            });

        return $this;
    }
}
