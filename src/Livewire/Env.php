<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Livewire\Component;

class Env extends Component
{
    public ?string $env;

    public ?string $command = null;

    public function mount(): void
    {
        $this->env = LaravelForgePanel::env();
    }

    public function save(): void
    {
        try {
            LaravelForgePanel::updateSiteEnvFile($this->env);

            session()->flash('env-message', [
                'type' => 'success',
                'message' => 'Env successfully updated.',
            ]);

            if ($this->command) {
                LaravelForgePanel::executeSiteCommand(['command' => $this->command]);

                $this->dispatch('command-executed')->to(CommandHistory::class);
            }
        } catch (\Throwable $e) {
            session()->flash('env-message', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('laravel-forge-panel::livewire.env');
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.env-placeholder');
    }
}
