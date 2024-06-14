<div x-data="{ open: true }">
    @foreach($history as $historyMessage)
        <div class="container {{ !$historyMessage['outgoing'] ? 'darker' : '' }}">
            <img src="/images/default-avatar.jpg" alt="Avatar"
                 class="{{ !$historyMessage['outgoing'] ? 'right' : '' }}">
            <p>{{ $historyMessage['message'] }}</p>
            <span
                class="{{ $historyMessage['outgoing'] ? 'time-right' : 'time-left' }}">{{ $historyMessage['time'] }}</span>
        </div>
    @endforeach
    <form wire:submit.prevent="sendMessage" class="flex gap-2">
        <x-text-input wire:model="message" x-ref="messageInput" name="message" id="message" class="block w-full"/>
        <x-primary-button>
            Send
        </x-primary-button>
    </form>
</div>
