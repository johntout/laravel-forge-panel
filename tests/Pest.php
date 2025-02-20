<?php

use Illuminate\Support\Facades\Gate;
use JohnTout\LaravelForgePanel\Tests\TestCase;
use Workbench\App\Models\User;

uses(TestCase::class)->in(__DIR__);

function asAdmin(): TestCase
{
    $user = User::factory()->create(['email' => 'test@laravel-forge-panel.com']);

    Gate::define('viewLaravelForgePanel', function (User $user) {
        return $user->email == 'test@laravel-forge-panel.com';
    });

    return test()->actingAs($user);
}