<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Facades;

use Illuminate\Support\Facades\Facade;
use JohnTout\LaravelForgePanel\Services\LaravelForgePanelService;

/**
 * @method static apiUrl()
 * @method static server()
 * @method static site()
 * @method static env()
 * @method static updateSiteEnvFile(string $content)
 * @method static executeSiteCommand(array $data)
 * @method static commandHistory()
 * @method static assertRequestSent()
 */
class LaravelForgePanel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaravelForgePanelService::class;
    }
}
