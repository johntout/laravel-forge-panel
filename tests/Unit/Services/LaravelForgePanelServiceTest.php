<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use JohnTout\LaravelForgePanel\Facades\LaravelForgePanel;
use JohnTout\LaravelForgePanel\Services\LaravelForgePanelService;
use Laravel\Forge\Resources\Server;
use Laravel\Forge\Resources\Site;

test('laravel forge panel service fails without token', function () {
    expect(fn () => new LaravelForgePanelService())
        ->toThrow(exception: Exception::class, exceptionMessage: 'LARAVEL_FORGE_TOKEN is missing!');
});

test('laravel forge panel service fails without server id', function () {
    expect(fn () => new LaravelForgePanelService(['token' => 'token']))
        ->toThrow(exception: Exception::class, exceptionMessage: 'LARAVEL_FORGE_SERVER_ID is missing!');
});

test('laravel forge panel service fails without site id', function () {
    expect(fn () => new LaravelForgePanelService(['token' => 'token', 'server_id' => 'server_id']))
        ->toThrow(exception: Exception::class, exceptionMessage: 'LARAVEL_FORGE_SITE_ID is missing!');
});

test('laravel forge panel service instantiates', function () {
    expect(fn () => new LaravelForgePanelService([
        'token' => 'token', 'server_id' => 'server_id', 'site_id' => 'site_id',
    ]))->toBeObject();
});

test('server function', function () {
    Http::fake(function () {
        return Http::response(['server' => []]);
    });

    expect(LaravelForgePanel::server())->toEqual(new Server([]));

    Http::assertSentCount(1);

    Http::assertSent(function (Request $request) {
        return $request->url() == LaravelForgePanel::apiUrl().'/servers/server_id';
    });
});

test('site function', function () {
    Http::fake(function () {
        return Http::response(['site' => []]);
    });

    expect(LaravelForgePanel::site())->toEqual(new Site([]));

    Http::assertSentCount(1);

    Http::assertSent(function (Request $request) {
        return $request->url() == LaravelForgePanel::apiUrl().'/servers/server_id/sites/site_id';
    });
});

test('env function', function () {
    Http::fake();

    expect(LaravelForgePanel::env())->toEqual('');

    Http::assertSentCount(1);

    Http::assertSent(function (Request $request) {
        return $request->url() == LaravelForgePanel::apiUrl().'/servers/server_id/sites/site_id/env';
    });
});

test('update site env', function () {
    Http::fake();

    LaravelForgePanel::updateSiteEnvFile('test data');

    Http::assertSentCount(1);

    Http::assertSent(function (Request $request) {
        return $request->url() == LaravelForgePanel::apiUrl().'/servers/server_id/sites/site_id/env' &&
            $request->method() == 'PUT';
    });
});

test('execute site command', function () {
    Http::fake();

    LaravelForgePanel::executeSiteCommand(['ls -ali']);

    Http::assertSentCount(1);

    Http::assertSent(function (Request $request) {
        return $request->url() == LaravelForgePanel::apiUrl().'/servers/server_id/sites/site_id/commands' &&
            $request->method() == 'POST';
    });
});

test('command history', function () {
    Http::fake(function () {
        return Http::response(['commands' => []]);
    });

    expect(LaravelForgePanel::commandHistory())->toBeArray();

    Http::assertSentCount(1);

    Http::assertSent(function (Request $request) {
        return $request->url() == LaravelForgePanel::apiUrl().'/servers/server_id/sites/site_id/commands';
    });
});
