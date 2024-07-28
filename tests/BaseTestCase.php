<?php

namespace Dipesh79\LaravelHelpers\Tests;

use Dipesh79\LaravelHelpers\LaravelHelpersServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;


abstract class BaseTestCase extends Orchestra
{
    use RefreshDatabase;

    public function getPackageProviders($app): array
    {
        return [
            LaravelHelpersServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->artisan('migrate')->run();
    }

    protected function getEnvironmentSetUp($app): void
    {
        // sqlite test database
        $app['config']->set('database.connections.the_test', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        // set config
        $app['config']->set('database.default', 'the_test');
        $app['config']->set('test', 'test');

    }
}
