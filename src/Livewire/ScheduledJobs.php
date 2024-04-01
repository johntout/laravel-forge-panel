<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Livewire;

use Illuminate\Support\Facades\Log;
use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use Livewire\Component;

class ScheduledJobs extends Component
{
    public function render()
    {
        try {
            $scheduledJobs = collect(LaravelForgePanel::listScheduledJobs())->sortByDesc('createdAt');
        } catch (\Throwable $e) {
            $scheduledJobs = collect();

            session()->flash('scheduled-jobs-message', [
                'type' => 'error',
                'message' => 'Issue when retrieving scheduled jobs data. Please hit reload!',
            ]);

            Log::error($e->getMessage());
        }

        return view('laravel-forge-panel::livewire.scheduled-jobs', [
            'scheduledJobs' => $scheduledJobs->values()->all(),
        ]);
    }

    public function placeholder()
    {
        return view('laravel-forge-panel::livewire.placeholders.scheduled-jobs-placeholder');
    }
}
