<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Kanye Rest Quotes') }}
    </h2>
</x-slot>

<div class="py-12" wire:init="getQuotes">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex items-center justify-between">
                <span class="bg-gray-100 pr-3 text-base font-semibold text-blue-800">Kanye quotes</span>
                <button type="button"
                        {{ $pageLoaded ? '' : 'disabled' }}
                        wire:click="getQuotes"
                        class="disabled:pointer-events-none disabled:opacity-50 inline-flex items-center gap-x-1.5 rounded-full bg-white px-3 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg wire:loading.class="animate-spin"
                         class="w-5 h-5 -ml-1 -mr-0.5 size-5 text-gray-400"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3zm4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54l1.41-1.41zM10 20l-4-4 4-4v8zm0-12V0l4 4-4 4z"></path>
                    </svg>
                    <span class="text-yellow-700 hover:text-yellow-500">Refresh</span>
                </button>
            </div>
        </div>

        <div class="space-y-3">
            <div wire:loading.class="py-6"
                 class="bg-white flex justify-center overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div wire:loading.class.remove="hidden" class="flex hidden items-center text-gray-600 space-x-3">
                    <svg class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-xl font-medium">
                        Getting quotes...
                    </p>
                </div>
            </div>
        </div>

        <div wire:loading.remove class="space-y-3">
            @forelse($quotes as $quote)
                <div wire:key="quote-{{$loop->iteration}}"
                     id="quote-{{$loop->iteration}}"
                     class="bg-white flex justify-center overflow-hidden shadow-sm sm:rounded-lg mt-8">
                    <p class="p-6 font-medium text-gray-900">
                        <span class="text-sm text-gray-400">{{ $loop->iteration }}. </span>
                        "{{ $quote }}"
                        <span class="text-gray-400">-Kanye West</span>
                    </p>
                </div>
            @empty
                <div class="bg-white flex justify-center overflow-hidden shadow-sm sm:rounded-lg mt-8">
                    <p class="p-6 font-medium text-gray-900">
                        No quotes found
                </div>
            @endforelse
        </div>
    </div>
</div>

