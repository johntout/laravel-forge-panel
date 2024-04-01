<?php

use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Livewire\ScheduledJobs;

use function Pest\Livewire\livewire;

beforeEach(function () {
    Http::fake(function () {
        return Http::response(['jobs' => []]);
    });
});

test('component renders', function () {
    livewire(ScheduledJobs::class)
        ->assertOk()
        ->assertSee(__('Scheduled Jobs'));
});
