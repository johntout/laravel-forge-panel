<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use Illuminate\Support\Facades\Log;
use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Laravel\Forge\Resources\Site;
use Livewire\Component;

class SiteInformation extends Component
{
    public function render()
    {
        try {
            $site = LaravelForgePanel::site();
        } catch (\Throwable $e) {
            $site = new Site([]);

            session()->flash('site-message', [
                'type' => 'error',
                'message' => 'Issue when retrieving site info. Please hit reload!',
            ]);

            Log::error($e->getMessage());
        }

        return view('laravel-forge-panel::livewire.site-information', [
            'site' => $site,
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.site-information-placeholder');
    }
}
