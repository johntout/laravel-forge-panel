<?php

use Illuminate\Support\Facades\Route;
use JohnTout\LaravelForgePanel\Http\Controllers\LaravelForgePanelController;

Route::middleware(config('laravel-forge-panel.middleware'))
    ->get(config('laravel-forge-panel.route'), LaravelForgePanelController::class)
    ->name('laravel-forge-panel');
