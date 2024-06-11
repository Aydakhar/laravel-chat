<?php

namespace App\Livewire;

use App\Jobs\SendMessage;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public string $message = '';
    public $history;

    public function sendMessage(): void
    {
        SendMessage::dispatch($this->message, auth()->id(), auth()->id());
        $this->message = '';
    }

    public function mount(): void
    {
//        $messages = Message::where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id())->get();
        $messages = Message::all();
        $this->history = $messages->map(function ($message) {
           return [
               'senderUsername' => $message->sender->name,
               'message' => $message->message
           ];
        });
    }

    #[On('echo:all_users_channel,GotMessage')]
    public function listenForMessageEvents($data) {
        $this->history[] = ['senderUsername' => $data['senderUsername'], 'message' => $data['message']];
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
