<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use JohnTout\LaravelForgePanel\Commands\InstallCommand;
use JohnTout\LaravelForgePanel\Livewire\CommandHistory;
use JohnTout\LaravelForgePanel\Livewire\Env;
use JohnTout\LaravelForgePanel\Livewire\ServerInformation;
use JohnTout\LaravelForgePanel\Livewire\SiteInformation;
use JohnTout\LaravelForgePanel\Services\LaravelForgePanelService;
use Livewire\Livewire;

class LaravelForgePanelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LaravelForgePanelService::class, function ($app) {
            return new LaravelForgePanelService($app['config']['laravel-forge-panel']);
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-forge-panel.php', 'laravel-forge-panel'
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-forge-panel');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-forge-panel'),
        ]);

        $this->publishes([
            __DIR__.'/../config/laravel-forge-panel.php' => config_path('laravel-forge-panel.php'),
        ], 'laravel-forge-panel-config');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/laravel-forge-panel'),
        ], 'laravel-forge-panel-assets');

        if ($this->app->environment('local')) {
            Gate::define('viewLaravelForgePanel', fn ($user = null) => true);
        }

        if ($this->app->runningInConsole()) {
            $this->commands([InstallCommand::class]);
        }

        Livewire::component('server-information', ServerInformation::class);
        Livewire::component('site-information', SiteInformation::class);
        Livewire::component('env', Env::class);
        Livewire::component('command-history', CommandHistory::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [LaravelForgePanelService::class];
    }
}
