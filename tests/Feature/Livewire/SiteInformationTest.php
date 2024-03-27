<?php

use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Livewire\SiteInformation;

use function Pest\Livewire\livewire;

test('component renders', function () {
    Http::fake(function () {
        return Http::response(['site' => ['id' => 1]]);
    });

    livewire(SiteInformation::class)
        ->assertOk()
        ->assertSee(__('Site Information'))
        ->assertSeeHtml('<div>ID: 1</div>');

    Http::assertSentCount(1);
});
