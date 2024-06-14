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
    public $user;

    public function sendMessage(): void
    {
        SendMessage::dispatch($this->message, auth()->id(), $this->user->id);
        $this->message = '';
    }

    public function mount(): void
    {
        $messages = Message::where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id())->get();
        $this->history = $messages->map(function ($message) {
           return [
               'senderUsername' => $message->sender->name,
               'message' => $message->message,
               'outgoing' => $message->sender->id === auth()->id(),
               'time' => $message->created_at->diffForHumans(),
           ];
        });
    }

    #[On('echo:all_users_channel,GotMessage')]
    public function listenForMessageEvents($data) {
        $this->history[] = [
            'senderUsername' => $data['senderUsername'],
            'message' => $data['message'],
            'outgoing' => $data['senderId'] === auth()->id(),
            'time' => $data['time'],
        ];
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
