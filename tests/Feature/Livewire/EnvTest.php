<?php

use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Livewire\Env;

use function Pest\Livewire\livewire;

beforeEach(function () {
    Http::fake();
});


test('function save can not be called due to 403', function () {
    livewire(Env::class)
        ->call('save', '1.ls -ali')
        ->assertForbidden();
});

test('component renders', function () {
    livewire(Env::class)
        ->assertOk()
        ->assertSee(__('Env File'));

    Http::assertSentCount(1);
});

test('save only with env', function () {
    asAdmin();

    livewire(Env::class)
        ->call('save');

    Http::assertSentCount(2);
});

test('save with command', function () {
    asAdmin();

    livewire(Env::class, ['command' => 'test-command'])
        ->assertSet('command', 'test-command')
        ->call('save')
        ->assertDispatched('command-executed');

    Http::assertSentCount(3);
});
