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

test('run function', function () {
    livewire(CommandHistory::class)
        ->call('run', '1.ls -ali')
        ->assertOk();

    Http::assertSentCount(3);
});
