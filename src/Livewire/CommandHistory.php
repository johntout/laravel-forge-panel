<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Livewire\Attributes\On;
use Livewire\Component;

class CommandHistory extends Component
{
    #[On('command-executed')]
    public function render()
    {
        $commandHistory = collect(LaravelForgePanel::commandHistory())->sortByDesc('createdAt');

        return view('laravel-forge-panel::livewire.command-history', [
            'commandHistory' => $commandHistory->values()->all(),
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.command-history-placeholder');
    }

    public function run(string $command): void
    {
        LaravelForgePanel::executeSiteCommand(['command' => explode('.', $command)[1]]);
    }
}
