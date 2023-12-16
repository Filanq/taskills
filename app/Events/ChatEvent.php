<?php

namespace App\Events;

use App\Broadcasting\ChatBroadcast;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatEvent extends Event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message = '';
    public $user_id = 0;
    public $sender_id = 0;
    public $avatar = '';
    public function __construct($message, $user_id, $sender_id)
    {
        $this->user_id = $user_id;
        $this->sender_id = $sender_id;
        $this->message = $message;
        $this->avatar = DB::table('users_data')->where('user_id', $this->sender_id)->first()->avatar;
    }

    public function broadcastWith(): array
    {
        return ["sender_id" => $this->sender_id, "user_id" => $this->user_id, "message" => $this->message, "avatar" => $this->avatar];
    }

    public function broadcastOn(): Channel
    {
        return new Channel('user.' . $this->sender_id . '.' . $this->user_id);
    }
}