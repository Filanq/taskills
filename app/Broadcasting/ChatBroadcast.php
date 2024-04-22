<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatBroadcast
{
    /**
     * Create a new channel instance.
     */
    public function __construct($obj)
    {

    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(): array|bool
    {
        return auth()->id() === $this->sender_id;
    }
}
