<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Livewire\Component;

class SiteInformation extends Component
{
    public function render()
    {
        return view('laravel-forge-panel::livewire.site-information', [
            'site' => LaravelForgePanel::site(),
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.site-information-placeholder');
    }
}
