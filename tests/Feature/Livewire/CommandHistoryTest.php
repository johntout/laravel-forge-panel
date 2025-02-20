<?php

use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Livewire\CommandHistory;

use function Pest\Livewire\livewire;

beforeEach(function () {
    Http::fake(function () {
        return Http::response(['commands' => []]);
    });
});

test('component renders', function () {
    livewire(CommandHistory::class)
        ->assertOk()
        ->assertSee(__('Command History'));

    Http::assertSentCount(1);
});

test('function run can not be called due to 403', function () {
    livewire(CommandHistory::class)
        ->call('run', '1.ls -ali')
        ->assertForbidden();
});

test('function run work as expected', function () {
    asAdmin();

    livewire(CommandHistory::class)
        ->call('run', '1.ls -ali')
        ->assertOk();

    Http::assertSentCount(3);
});
