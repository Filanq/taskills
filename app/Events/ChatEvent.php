<?php

namespace App\Events;

use App\Broadcasting\ChatBroadcast;
use App\Models\User;
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
    public $sender_name = '';
    public function __construct($message, $user_id, $sender_id)
    {
        $this->user_id = $user_id;
        $this->sender_id = $sender_id;
        $this->message = $message;
        $this->avatar = DB::table('users_data')->where('user_id', $this->sender_id)->first()->avatar;
        $this->sender_name = User::find($sender_id);
        $this->sender_name = $this->sender_name->firstname . ' ' . $this->sender_name->surname;
    }

    public function broadcastWith(): array
    {
        return ["sender_id" => $this->sender_id, "user_id" => $this->user_id, "message" => $this->message, "sender_name" => $this->sender_name, "avatar" => $this->avatar];
    }

    public function broadcastOn(): array
    {
        return [new Channel('user.' . $this->sender_id . '.' . $this->user_id), new Channel('message.' . $this->user_id)];
    }
}
