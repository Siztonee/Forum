<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class MessageReactions extends Component
{
    public $message;
    public $reactions;
    public $emojis;

    public function mount($message)
    {
        $this->message = $message;

        $emojisData = json_decode(file_get_contents(resource_path('json/emojis.json')), true);
        $this->emojis = $emojisData['emojis'];
        
        $this->loadReactions();
    }

    public function loadReactions()
    {
        $this->message->load(['reactions', 'sender']);

        $this->reactions = $this->message->reactions()
            ->get()
            ->groupBy('reaction')
            ->map(function($group) {
                return $group->count();
            });
    }

    public function addReaction($reaction, NotificationService $notificationService)
    {
        if (!Auth::check()) {
            return redirect()->route('auth');
        }

        Reaction::where('sender_id', auth()->id())
            ->where('message_id', $this->message->id)
            ->delete();

        Reaction::create([
            'sender_id' => auth()->id(),
            'message_id' => $this->message->id,
            'reaction' => $reaction
        ]);

        if ($this->message->sender->id !== auth()->id()) {
            $notificationService->createNotification(
                sender_id: auth()->id(),
                receiver_id: $this->message->sender->id,
                type: 'reaction',
                topicName: $this->message->topic->name,
                reaction: $reaction
            );
        }

        $this->loadReactions();
    }

    public function render()
    {
        return view('livewire.message-reactions', [
            'reactionCounts' => $this->reactions->count()
        ]);
    }
}
