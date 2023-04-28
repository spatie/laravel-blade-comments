<?php

namespace Spatie\BladePaths;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\BladePaths\Commands\BladePathsCommand;

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
        Blade::directive('include', function ($expression) {
            $bladeCompiler = app(BladeCompiler::class);

            $compiled = invade($bladeCompiler)->compileInclude($expression);

            $partial = trim($expression, "'");
            $startComment = "<!-- Start of partial: {$partial} -->\n";
            $endComment = "\n<!-- End of partial: {$partial} -->";

            return $startComment . $compiled . $endComment;
        });

        Blade::directive('extends', function ($expression) {
            $bladeCompiler = app(BladeCompiler::class);

            $compiled = invade($bladeCompiler)->compileExtends($expression);

            $template = trim($expression, "'");
            $startComment = "<!-- Blade View Extends: {$template} -->\n";

            return $startComment . $compiled;
        });

//        Livewire::listen('component.dehydrate.initial', function ($component, $response) {
//            if (! $html = data_get($response, 'effects.html')) return;
//
//            $componentName = get_class($component) . ' (' . $component->getName() . ')';
//
//            $startComment = "<!-- Start Livewire Component {$componentName} -->";
//            $pos = strpos($html, '>') + 1;
//            $newHtml = substr_replace($html, " {$startComment}", $pos, 0);
//
//            $endComment = "<!-- End of Livewire Component {$componentName} -->";
//
//            data_set($response, 'effects.html', $newHtml . $endComment);
//        });
    }
}
