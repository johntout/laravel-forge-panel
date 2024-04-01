<div class="w-full gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
    <div>
        @if (session()->has('server-message'))
            @include('laravel-forge-panel::message', ['message' => session('server-message')])
        @endif
    </div>
    <div class="flex justify-between">
        <div class="pb-2 text-lg text-gray-600 leading-7 font-semibold dark:text-white">{{ __('Server Information') }}</div>
        <div wire:loading.class="opacity-0">
            <svg wire:click="$refresh" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-white/70 dark:hover:text-white/80 cursor-pointer text-black/70 hover:text-black">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </div>
        <div wire:loading>
            <svg class="animate-spin ml-2 h-5 text-black dark:text-white text-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    <div wire:loading.class="opacity-50">
        <div>ID: {{ $server->id }}</div>
        <div>Name: {{ $server->name }}</div>
        <div>Type: {{ $server->type }}</div>
        <div>Region: {{ $server->region }}</div>
        <div>IP Address: {{ $server->ipAddress }}</div>
        <div>Private IP Address: {{ $server->privateIpAddress }}</div>
        <div>PHP Version: {{ $server->phpVersion }}</div>
    </div>
</div>