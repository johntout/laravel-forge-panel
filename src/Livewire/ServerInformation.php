<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Livewire\Component;

class ServerInformation extends Component
{
    public function render()
    {
        return view('laravel-forge-panel::livewire.server-information', [
            'server' => LaravelForgePanel::server(),
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.server-information-placeholder');
    }
}
