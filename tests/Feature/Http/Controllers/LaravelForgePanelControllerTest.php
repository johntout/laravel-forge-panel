<?php

use Illuminate\Support\Facades\Gate;
use JohnTout\LaravelForgePanel\Livewire\CommandHistory;
use JohnTout\LaravelForgePanel\Livewire\Env;
use JohnTout\LaravelForgePanel\Livewire\ScheduledJobs;
use JohnTout\LaravelForgePanel\Livewire\ServerInformation;
use JohnTout\LaravelForgePanel\Livewire\SiteInformation;
use Workbench\App\Models\User;

test('controller returns 403 response', function () {
    $this
        ->get(config('laravel-forge-panel.route'))
        ->assertForbidden();
});

test('controller returns 200 response', function () {

    $user = User::factory()->create(['email' => 'test@laravel-forge-panel.com']);

    Gate::define('viewLaravelForgePanel', function (User $user) {
        return $user->email == 'test@laravel-forge-panel.com';
    });

    $this
        ->actingAs($user)
        ->get(config('laravel-forge-panel.route'))
        ->assertOk()
        ->assertSeeLivewire(ServerInformation::class)
        ->assertSeeLivewire(SiteInformation::class)
        ->assertSeeLivewire(Env::class)
        ->assertSeeLivewire(CommandHistory::class)
        ->assertSeeLivewire(ScheduledJobs::class);
});
