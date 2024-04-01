<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Panel for Laravel Forge</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

{{--        <link href="{{ asset('vendor/laravel-forge-panel/app-B86EBUZl.css') }}" rel="stylesheet">--}}
{{--        <script src="{{ asset('vendor/laravel-forge-panel/app-D2jpX1vH.js') }}"></script>--}}

        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gradient-to-r from-cyan-900 to-blue-900 bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <main class="mt-6">
                        <div class="grid gap-6 lg:gap-8">
                            <div class="grid lg:grid-cols-2 gap-6 w-full">
                                <livewire:server-information lazy />
                                <livewire:site-information lazy />
                            </div>

                            <livewire:env lazy />
                            <livewire:command-history lazy />
                            <livewire:scheduled-jobs lazy />
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
