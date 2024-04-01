<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Laravel\Forge\Resources\Job;
use Laravel\Forge\Resources\Server;
use Laravel\Forge\Resources\Site;
use Laravel\Forge\Resources\SiteCommand;

class LaravelForgePanelService
{
    private string $apiUrl = 'https://forge.laravel.com/api/v1';

    private PendingRequest $pendingRequest;

    private string $serverId;

    private string $siteId;

    /**
     * Create a new class instance.
     *
     * @throws \Exception
     */
    public function __construct(array $config = [])
    {
        if (empty(Arr::get($config, 'token'))) {
            throw new \Exception('LARAVEL_FORGE_TOKEN is missing!');
        }

        if (empty(Arr::get($config, 'server_id'))) {
            throw new \Exception('LARAVEL_FORGE_SERVER_ID is missing!');
        }

        if (empty(Arr::get($config, 'site_id'))) {
            throw new \Exception('LARAVEL_FORGE_SITE_ID is missing!');
        }

        $this->pendingRequest = Http::withToken($config['token'])
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->withOptions([
                'http_errors' => false,
            ]);

        $this->serverId = $config['server_id'];
        $this->siteId = $config['site_id'];
    }

    public function apiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @throws RequestException
     */
    public function server(): Server
    {
        $response = $this->pendingRequest->get($this->apiUrl.'/servers/'.$this->serverId);

        $response->throw();

        return new Server($response->json()['server']);
    }

    /**
     * @throws RequestException
     */
    public function site(): Site
    {
        $response = $this->pendingRequest
            ->get($this->apiUrl.'/servers/'.$this->serverId.'/sites/'.$this->siteId);

        $response->throw();

        return new Site($response->json()['site']);
    }

    /**
     * @throws RequestException
     */
    public function env(): string
    {
        $response = $this->pendingRequest
            ->get($this->apiUrl.'/servers/'.$this->serverId.'/sites/'.$this->siteId.'/env');

        $response->throw();

        return $response->body();
    }

    /**
     * @throws RequestException
     */
    public function updateSiteEnvFile(string $content): void
    {
        $response = $this->pendingRequest
            ->put(
                $this->apiUrl.'/servers/'.$this->serverId.'/sites/'.$this->siteId.'/env',
                compact('content')
            );

        $response->throw();
    }

    /**
     * @throws RequestException
     */
    public function executeSiteCommand(array $data): void
    {
        $response = $this->pendingRequest
            ->post($this->apiUrl.'/servers/'.$this->serverId.'/sites/'.$this->siteId.'/commands', $data);

        $response->throw();
    }

    /**
     * @throws RequestException
     */
    public function commandHistory(): array
    {
        $response = $this->pendingRequest
            ->get($this->apiUrl.'/servers/'.$this->serverId.'/sites/'.$this->siteId.'/commands');

        $response->throw();

        return $this->transformData($response->json()['commands'], SiteCommand::class);
    }

    /**
     * @throws RequestException
     */
    public function listScheduledJobs(): array
    {
        $response = $this->pendingRequest
            ->get($this->apiUrl.'/servers/'.$this->serverId.'/jobs');

        $response->throw();

        return $this->transformData($response->json()['jobs'], Job::class);
    }

    private function transformData(array $forgeData, string $class): array
    {
        return array_map(function ($data) use ($class) {
            return new $class($data);
        }, $forgeData);
    }
}
