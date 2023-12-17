<?php

namespace App\Http\Controllers;

use App\Events\callEvent;
use App\Events\callQuitEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallController extends Controller
{
    public function index(Request $request){
        $answer_id = $request->answer_id;
        $offer_id = $request->offer_id;
        $call = DB::table('calls')->where('offer_id', $offer_id)->first() ?? null;
        if($call){
            if(auth()->id() == $offer_id){
                DB::table('calls')->where('offer_id', $offer_id)->delete();
                $call = null;
            }
            else if($call->answered == 1){
                return redirect()->route('index');
            }
        }
        $call_id = $call ? $call->call_id : 0;
        if(auth()->id() == $answer_id){
            $remote_user = User::find($offer_id)->getFullData();
        }
        else{
            $remote_user = User::find($answer_id)->getFullData();
        }

        return view('templates.call', ["call_id" => $call_id, 'remote_user' => $remote_user, 'offer_id' => $offer_id, 'answer_id' => $answer_id]);
    }
    public function create(Request $request){
        DB::table('calls')->insert([
            "call_id" => $request->call_id,
            "answer_id" => $request->answer_id,
            "offer_id" => $request->offer_id
        ]);

        broadcast(new callEvent($request->answer_id, $request->call_id));
    }
    public function answer(Request $request){
        $call = DB::table('calls')->where('call_id', $request->call_id)->first();
        if($call->answer_id == auth()->id()){
            DB::table('calls')->where('call_id', $request->call_id)->update([
                "answered" => 1
            ]);
        }
    }
    public function quit(Request $request){
        DB::table('calls')->where('call_id', $request->call_id)->delete();
        broadcast(new callQuitEvent($request->call_id));
    }
}
