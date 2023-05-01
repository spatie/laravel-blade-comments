<?php

namespace Spatie\BladePaths\Tests;

use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\BladePaths\BladePathsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('view:clear');

        View::addLocation(__DIR__.'/TestSupport/views');
    }

    protected function getPackageProviders($app)
    {
        return [
            BladePathsServiceProvider::class,
        ];
    }

    public function rerunServiceProvider()
    {
        $provider = new BladePathsServiceProvider($this->app);

        $provider->packageBooted();
    }
}
