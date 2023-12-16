<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(Request $request, User $user){
        $curr_user = $user;
        $logs = $user->getLogs(User::isMedic($user));
        $certificates = $user->getCertificates(User::isMedic($user));
        if(!auth()->id()){
            $curr_user = null;
        }
        if($user->id !== auth()->id() && auth()->id()){
            $curr_user = User::find(auth()->id());
        }
        $is_guest = is_null($curr_user) ? true : $curr_user->id !== $user->id;
        $chat_data = null;
        if($is_guest && $curr_user !== null){
            $curr_user = $curr_user->getFullData();
            $chat_data = Message::whereRaw("(user_id = {$curr_user->id} AND sender_id = {$user->id}) OR (sender_id = {$curr_user->id} AND user_id = {$user->id})")->orderBy("date", "ASC")->limit(50)->get();
        }

        if(User::isMedic($user)){
            return view('templates.profile-medic', ["chat_data" => $chat_data, 'certificates' => $certificates, 'logs' => $logs, 'user' => $user->getFullData(), 'curr_user' => $curr_user, 'is_guest' => $is_guest]);
        }
        else{
            return view('templates.profile-person', ["chat_data" => $chat_data, 'logs' => $logs, 'user' => $user->getFullData(), 'curr_user' => $curr_user, 'is_guest' => $is_guest]);
        }
    }
}
