<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request){
        if(!isset($_COOKIE['was']) && !auth()->check()){
            setcookie('was', '1', 9999999999);
            return view('templates.opportunities');
        }
        if(!auth()->check()){
            return redirect()->route('register');
        }
        $medics_type = [
            'oculus' => 'Окулист',
            'hirurg' => 'Хирург',
            'stomat' => 'Стоматолог',
            'psih' => 'Психолог',
            'cardio' => 'Кардиолог',
            'derm' => 'Дерматолог'
        ];
        $medics = [];
        foreach ($medics_type as $type => $name){
            $medics[$type] = DB::select("SELECT users.*, users_data.id as users_data_id, users_data.avatar, users_data.specialization FROM users, users_data WHERE users.id = users_data.id AND users_data.specialization = '$name' AND users.status = 'medic'");
        }
        return view('templates.index', ['medics_type' => $medics_type, 'medics' => $medics]);
    }
    public function search(Request $request){
        $query = $request->input("query");
        if(trim($query) == ''){
            return [];
        }
        $users = User::whereRaw("CONCAT(firstname, surname) LIKE '%{$query}%' AND status = 'medic'")->get();
        $response = [];
        foreach($users as $user){
            $us = $user->getFullData();
            $response[] = ["avatar" => $us->avatar, "name" => $us->firstname, 'specialization' => $us->specialization, 'id' => $us->id];
        }

        return $response;
    }
}
