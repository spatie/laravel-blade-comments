<?php

namespace Spatie\BladePaths\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\BladePaths\BladePathsServiceProvider;
use Spatie\BladePaths\Tests\TestSupport\BladeComponents\TestBladeComponent;
use Spatie\BladePaths\Tests\TestSupport\Livewire\TestLivewireComponent;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('view:clear');
    }

    protected function getPackageProviders($app)
    {
        return [
            BladePathsServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

        View::addLocation(__DIR__.'/TestSupport/views');

        Blade::component('test-component', TestBladeComponent::class);
        Livewire::component('test-component', TestLivewireComponent::class);
    }

    public function rerunServiceProvider()
    {
        $provider = new BladePathsServiceProvider($this->app);

        $provider->packageBooted();
    }

    public function preparedLivewireHtmlForSnapshot(string $html): string
    {
        // remove wire:id and wire:initial-data attributes
        $html = preg_replace('/<div\s+(?=.*?\bwire:id\b)(?=.*?\bwire:initial-data\b)(.*?)\bwire:id\b\s*=\s*"[^"]*"\s*\bwire:initial-data\b\s*=\s*"[^"]*"\s*(.*?)>/s', '<div $1$2>', $html);

        // remove wire:end random string
        $html = preg_replace('/wire-end:[^ ]+\s*/', '', $html);

        return $html;
    }
}
