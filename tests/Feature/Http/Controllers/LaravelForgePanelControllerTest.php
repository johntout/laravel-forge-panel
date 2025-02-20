<?php

use JohnTout\LaravelForgePanel\Livewire\CommandHistory;
use JohnTout\LaravelForgePanel\Livewire\Env;
use JohnTout\LaravelForgePanel\Livewire\ScheduledJobs;
use JohnTout\LaravelForgePanel\Livewire\ServerInformation;
use JohnTout\LaravelForgePanel\Livewire\SiteInformation;

test('controller returns 403 response', function () {
    $this
        ->get(config('laravel-forge-panel.route'))
        ->assertForbidden();
});

test('controller returns 200 response', function () {

        asAdmin()
        ->get(config('laravel-forge-panel.route'))
        ->assertOk()
        ->assertSeeLivewire(ServerInformation::class)
        ->assertSeeLivewire(SiteInformation::class)
        ->assertSeeLivewire(Env::class)
        ->assertSeeLivewire(CommandHistory::class)
        ->assertSeeLivewire(ScheduledJobs::class);
});
