<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use JohnTout\LaravelForgePanel\LaravelForgePanelServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Workbench\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LaravelForgePanelServiceProvider::class,
        ];
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->artisan('migrate', ['--database' => 'testing', '--path' => 'migrations']);

        $this->beforeApplicationDestroyed(
            fn () => $this->artisan('migrate:rollback', ['--database' => 'testing'])
        );
    }
}
