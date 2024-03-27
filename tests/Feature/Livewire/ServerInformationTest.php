<?php

use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Livewire\ServerInformation;

use function Pest\Livewire\livewire;

test('component renders', function () {
    Http::fake(function () {
        return Http::response(['server' => ['id' => 1]]);
    });

    livewire(ServerInformation::class)
        ->assertOk()
        ->assertSee(__('Server Information'))
        ->assertSeeHtml('<div>ID: 1</div>');

    Http::assertSentCount(1);
});
