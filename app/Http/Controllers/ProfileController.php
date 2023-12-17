<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
        $call_link = null;
        if($is_guest && $curr_user !== null){
            $curr_user = $curr_user->getFullData();
            $chat_data = Message::whereRaw("(user_id = {$curr_user->id} AND sender_id = {$user->id}) OR (sender_id = {$curr_user->id} AND user_id = {$user->id})")->orderBy("date", "ASC")->limit(50)->get();
            $call_link = DB::table('calls')->whereRaw('offer_id = ' . $user->id . ' AND answer_id = ' . $curr_user->id)->first();
        }

        if(User::isMedic($user)){
            return view('templates.profile-medic', ["call_link" => $call_link, "chat_data" => $chat_data, 'certificates' => $certificates, 'logs' => $logs, 'user' => $user->getFullData(), 'curr_user' => $curr_user, 'is_guest' => $is_guest]);
        }
        else{
            return view('templates.profile-person', ["call_link" => $call_link, "chat_data" => $chat_data, 'logs' => $logs, 'user' => $user->getFullData(), 'curr_user' => $curr_user, 'is_guest' => $is_guest]);
        }
    }

    public function change_view(Request $request){
        $user = User::find(auth()->id());
        return view('templates.profile-editor', ['user' => $user->getFullData(), 'is_medic' => User::isMedic($user)]);
    }

    public function change(Request $request){
        $user = User::find(auth()->id());
        $img = $request->file('img');
        $old_avatar = DB::table('users_data')->where('user_id', $user->id)->first()->avatar;

        $is_new = false;
        $filename = '';
        if($img){
            $is_new = !str_contains($img->getClientOriginalName(), '{old}');
            if($is_new){
                $filename = User::generateRandomString(16) . '.' . $img->getClientOriginalExtension();
                $tmp_name = $img->store();
                if(($old_file = $old_avatar) != 'avatar.svg'){
                    File::delete(__PROJECTDIR__ . 'public/img/avatars/' . $old_file);
                }
                rename(__PROJECTDIR__ . 'public/' . $tmp_name, __PROJECTDIR__ . 'public/img/avatars/' . $filename);
            }
            else{
                $filename = $old_avatar;
            }
        }
        else{
            if(($old_file = $old_avatar) != 'avatar.svg'){
                File::delete(__PROJECTDIR__ . 'public/img/avatars/' . $old_file);
            }
            $filename = 'avatar.svg';
        }

        $user->firstname = $request->input("firstname") ?? '';
        $user->surname = $request->input("surname") ?? '';
        $user->save();

        DB::table('users_data')->where('user_id', $user->id)->update([
            "avatar" => $filename,
            "age" => $request->input("age") ?? null,
            "sex" => $request->input("sex") ?? null,
            "status" => $request->input("status") ?? null,
            "location" => $request->input("location") ?? null,
            "graphic" => $request->input("graphic") ?? null,
            "specialization" => $request->input("specialization") ?? null
        ]);

        return redirect()->route('profile', ['user' => $user->id]);
    }

    public function change_password(Request $request){
        $password_old = $request->input("old_password");
        $password_new = $request->input("new_password");
        $user = User::find(auth()->id());
        if(Hash::check($password_old, $user->password)){
            if(mb_strlen(trim($password_new)) < 8){
                return response('Новый пароль слишком короткий', 500);
            }
            $user->password = Hash::make($password_new);
            $user->save();

            return response('success', 200);
        }
        else{
            return response('Нынешний пароль не совпадает', 500);
        }
    }
}
