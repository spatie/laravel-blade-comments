<?php

namespace Spatie\BladePaths\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
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
}
