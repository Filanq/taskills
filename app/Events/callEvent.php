<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class callEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $call_id = '';
    public $answer_id = 0;
    public $offer_id = 0;
    public $name = '';
    public $link = '';
    public function __construct($answer_id, $call_id, $offer_id)
    {
        $this->answer_id = $answer_id;
        $this->offer_id = $offer_id;
        $this->call_id = $call_id;
        $this->name = User::find($offer_id);
        $this->name = $this->name->firstname . ' ' . $this->name->surname;
        $this->link = route('call', ['offer_id' => $offer_id, 'answer_id' => $answer_id]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('callCreated.'.$this->answer_id),
        ];
    }
    public function broadcastWith(): array
    {
        return ["call_id" => $this->call_id, "answer_id" => $this->answer_id, 'name' => $this->name, 'link' => $this->link];
    }
}
