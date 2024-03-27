<div wire:poll.30s class="relative overflow-x-auto w-full gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
    <div class="pb-2 text-lg text-gray-600 leading-7 font-semibold dark:text-white">{{ __('Command History') }}</div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-400 uppercase border-b">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Command') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Status') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Run at') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Duration') }}
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandHistory as $siteCommand)
                @php
                    $lineClass = match ($siteCommand->status) {
                        'running' => 'bg-green-500',
                        'waiting' => 'bg-yellow-500',
                        default => ''
                    };
                @endphp
                <tr wire:key="{{ $siteCommand->id }}" class="border-b {{ $lineClass }}">
                    <td class="px-6 py-4 font-medium whitespace-nowrap text-black dark:text-white">
                        {{ $siteCommand->command }}
                    </td>
                    <td class="px-6 py-4 font-medium whitespace-nowrap text-black dark:text-white">
                        {{ $siteCommand->status }}
                    </td>
                    <td class="px-6 py-4 font-medium whitespace-nowrap text-black dark:text-white">
                        {{ $siteCommand->createdAt }}
                    </td>
                    <td class="px-6 py-4 font-medium whitespace-nowrap text-black dark:text-white">
                        {{ $siteCommand->duration }}
                    </td>
                    <td class="px-6 py-4 font-medium whitespace-nowrap text-black dark:text-white">
                        @if($siteCommand->status == 'finished')
                            <button wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="run('{{ $siteCommand->id.'.'.$siteCommand->command }}')"  wire:click="run('{{ $siteCommand->id.'.'.$siteCommand->command }}')" class="text-center bg-green-600 hover:bg-green-800 flex items-center p-2 pl-6 pr-6 rounded text-white">
                                <span class="flex">{{ __('Run again') }}</span>
                                <svg wire:loading wire:target="run('{{ $siteCommand->id.'.'.$siteCommand->command }}')" class="animate-spin ml-2 h-5 text-white text-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

