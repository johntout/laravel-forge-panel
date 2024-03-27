<?php

declare(strict_types=1);

namespace JohnTout\LaravelForgePanel\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class LaravelForgePanelController extends Controller
{
    use AuthorizesRequests;

    /**
     * Handle the incoming request.
     *
     * @throws AuthorizationException
     */
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('viewLaravelForgePanel');

        return view('laravel-forge-panel::forge-panel');
    }
}
