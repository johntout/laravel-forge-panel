<?php

use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Livewire\Env;

use function Pest\Livewire\livewire;

beforeEach(function () {
    Http::fake();
});

test('component renders', function () {
    livewire(Env::class)
        ->assertOk()
        ->assertSee(__('Env File'));

    Http::assertSentCount(1);
});

test('save only with env', function () {
    livewire(Env::class)
        ->call('save');

    Http::assertSentCount(2);
});

test('save with command', function () {
    livewire(Env::class, ['command' => 'test-command'])
        ->assertSet('command', 'test-command')
        ->call('save')
        ->assertDispatched('command-executed');

    Http::assertSentCount(3);
});
