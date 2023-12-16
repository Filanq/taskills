<?php

namespace App\Http\Controllers;

use App\Broadcasting\ChatBroadcast;
use App\Events\ChatEvent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function send(Request $request){
        if(!$this->isvalid($request)){
            return 'session is invalid';
        }

        Message::create([
            'user_id' => $request->user_id,
            'sender_id' => $request->sender_id,
            'message' => $request->message
        ]);

        broadcast(new ChatEvent($request->message, $request->user_id, $request->sender_id));

        return (object)["message" => $request->message, "avatar" => DB::table('users_data')->where('user_id', $request->sender_id)->first()->avatar];
    }

    protected function isvalid($request){
        if($request->sender_id != auth()->id()){
            return false;
        }
        if($request->sender_id == $request->user_id){
            return false;
        }
        return true;
    }
}
