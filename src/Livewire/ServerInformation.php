<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use Illuminate\Support\Facades\Log;
use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Laravel\Forge\Resources\Server;
use Livewire\Component;

class ServerInformation extends Component
{
    public function render()
    {
        try {
            $server = LaravelForgePanel::server();
        } catch (\Throwable $e) {
            $server = new Server([]);

            session()->flash('server-message', [
                'type' => 'error',
                'message' => 'Issue when retrieving server info. Please hit reload!',
            ]);

            Log::error($e->getMessage());
        }

        return view('laravel-forge-panel::livewire.server-information', [
            'server' => $server,
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.server-information-placeholder');
    }
}
