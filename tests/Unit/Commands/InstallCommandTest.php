<?php

test('install command', function () {
    $this->artisan('laravel-forge-panel:install')
        ->expectsOutput(__('Laravel Forge panel was installed successfully.'))
        ->assertExitCode(0);
});
