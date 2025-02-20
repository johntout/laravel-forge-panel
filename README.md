## Laravel Forge Panel

Add a panel to your app in order to manage various actions on Laravel Forge.

Currently supported actions are:

- Get server information
- Get site information
- Get and update .env file
- Execute commands

![Laravel Forge Panel](./laravel-forge-panel-screenshot.png?raw=true "Laravel Forge Panel")

## Installation

You can install the package via composer:

```
composer require johntout/laravel-forge-panel
```

Then run the install command to publish the assets.

```
php artisan laravel-forge-panel:install
```

In your `.env` file you must save the following env variables in order to connect to your Laravel Forge account:

```dotenv
LARAVEL_FORGE_TOKEN=
LARAVEL_FORGE_SERVER_ID=
LARAVEL_FORGE_SITE_ID=
```
You can obtain your token through your **[Laravel Forge profile](https://forge.laravel.com/user-profile/api)**. The server id and the site id can be found on the top of your Laravel Forge site page.

You can access the Laravel Forge panel by visiting the page `/forge-panel`. By default the panel is accessible in local environment. On production environment you must define the Gate below in the `boot` method of your `AppServiceProvider`, with your criteria, in order to access the panel.

```php
use App\Models\User;
use Illuminate\Support\Facades\Gate;

Gate::define('viewLaravelForgePanel', function (User $user) {
    return $user->is_developer;
});
```

Config file:

```php
return [
    'middleware' => [
        'web',
    ],
    'route' => 'forge-panel',
    'token' => env('LARAVEL_FORGE_TOKEN'),
    'server_id' => env('LARAVEL_FORGE_SERVER_ID'),
    'site_id' => env('LARAVEL_FORGE_SITE_ID'),
];

```

All config options can be overwritten by publishing the configuration file using `php artisan vendor:publish --tag=laravel-forge-panel-config`. If you add new configuration options they will be merged with the default ones from the package.

## License

The package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
