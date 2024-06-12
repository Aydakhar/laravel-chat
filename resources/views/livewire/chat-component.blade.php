<div x-data="{ open: true }" >
    <div :class="{'-translate-y-0': open, 'translate-y-full': !open}" class="fixed transition-all duration-300 transform bottom-10 right-12 h-60 w-80">
        <div class="w-full h-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded overflow-auto flex flex-col px-2 py-4">
            <div x-ref="chatBox" class="flex-1 p-4 text-sm flex flex-col gap-y-1">
                @foreach($history as $historyMessage)
                    <div><span class="{{$historyMessage['outgoing'] ? 'text-indigo-600' : 'text-red-600' }}">{{ $historyMessage['senderUsername'] }}:</span> <span class="dark:text-white">{{ $historyMessage['message'] }}</span></div>
                @endforeach
            </div>
            <div>
                <form wire:submit.prevent="sendMessage" class="flex gap-2">
                    <x-text-input wire:model="message" x-ref="messageInput" name="message" id="message" class="block w-full" />
                    <x-primary-button>
                        Send
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
