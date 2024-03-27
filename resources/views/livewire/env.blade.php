<div
    class="rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
>
    <div>
        @if (session()->has('env-message'))
            <div class="{{ session('env-message')['type'] == 'error' ? 'bg-red-600' : 'bg-green-600' }} text-white text-lg p-3 rounded-lg mb-5">
                {{ session('env-message')['message'] }}
            </div>
        @endif
    </div>
    <div class="pb-2 text-lg text-gray-600 leading-7 font-semibold dark:text-white">{{ __('Env File') }}</div>
    <textarea wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="save" wire:model="env" class="w-full rounded-lg bg-black text-white p-6" rows="20"></textarea>

    <div class="pt-5">
        <div class="pb-2">{{ __('Type a command to run after saving the env file') }}</div>
        <input wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="save" wire:model="command" type="text" class="w-full rounded-lg bg-black text-white p-2" placeholder="e.g. php artisan config:cache" />
    </div>

    <button wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:click="save" class="text-center bg-green-600 hover:bg-green-800 flex items-center p-2 pl-6 pr-6 mt-5 rounded text-white">
        <span class="flex">{{ __('Save') }}</span>
        <svg wire:loading wire:target="save" class="animate-spin ml-2 h-5 text-white text-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </button>
</div>
