<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'laravel-forge-panel:install';

    public $description = 'Install laravel forge panel';

    public function handle(): int
    {
        $this->callSilent('vendor:publish', ['--tag' => 'laravel-forge-panel-assets']);

        $this->info(__('Laravel Forge panel was installed successfully.'));

        return self::SUCCESS;
    }
}
