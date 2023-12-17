<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{sender_id}.{user_id}', \App\Broadcasting\ChatBroadcast::class);

Broadcast::channel('message.{user_id}', \App\Broadcasting\ChatBroadcast::class);

Broadcast::channel('callQuit.{callId}', function($callId){
    $call = \Illuminate\Support\Facades\DB::table('calls')->where('call_id', $callId)->first();
    return auth()->id() == $call->answer_id || auth()->id() == $call->offer_id;
});

Broadcast::channel('callCreated.{answer_id}', function($answer_id, $callId){
    $call = \Illuminate\Support\Facades\DB::table('calls')->where('call_id', $callId)->first();
    return auth()->id() == $call->offer_id;
});
