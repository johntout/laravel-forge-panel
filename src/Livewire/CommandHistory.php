<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Livewire\Attributes\On;
use Livewire\Component;

class CommandHistory extends Component
{
    #[On('command-executed')]
    public function render()
    {
        try {
            $commandHistory = collect(LaravelForgePanel::commandHistory())->sortByDesc('createdAt');
        } catch (\Throwable $e) {
            $commandHistory = collect();

            session()->flash('command-history-message', [
                'type' => 'error',
                'message' => 'Issue when retrieving command history data. Please hit reload!',
            ]);

            Log::error($e->getMessage());
        }

        return view('laravel-forge-panel::livewire.command-history', [
            'commandHistory' => $commandHistory->values()->all(),
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.command-history-placeholder');
    }

    /**
     * @throws AuthorizationException
     */
    public function run(string $command): void
    {
        $this->authorize('viewLaravelForgePanel');

        LaravelForgePanel::executeSiteCommand(['command' => explode('.', $command)[1]]);
    }
}
