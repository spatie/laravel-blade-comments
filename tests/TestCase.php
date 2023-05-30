<?php

namespace Spatie\BladeComments\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\BladeComments\BladeCommentsServiceProvider;
use Spatie\BladeComments\Tests\TestSupport\BladeComponents\TestBladeComponent;
use Spatie\BladeComments\Tests\TestSupport\Livewire\TestLivewireComponent;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        ray()->newScreen($this->name());

        $this->artisan('view:clear');
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeCommentsServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');
        config()->set('blade-comments.enable', true);

        View::addLocation(__DIR__.'/TestSupport/views');

        Blade::component('test-component', TestBladeComponent::class);
        Livewire::component('test-component', TestLivewireComponent::class);
    }

    public function rerunServiceProvider()
    {
        $provider = new BladeCommentsServiceProvider($this->app);

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
