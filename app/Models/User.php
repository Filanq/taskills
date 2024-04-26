<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'surname',
        'email',
        'password',
        'status'
    ];
    protected $table = 'users';
    public $timestamps = false;

    public static function isMedic($user): bool
    {
        return $user->status == 'medic';
    }

    public static function isPerson($user): bool
    {
        return $user->status == 'person';
    }

    static function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    public function getFullData(){
        $data = DB::select("SELECT users.*, users_data.* FROM users, users_data WHERE users.id = users_data.user_id AND users.id = {$this->id}")[0];
        if(($favorites = $data->favorites) !== '[]' && $data->status !== 'medic') {
            $query = 'SELECT users.*, users_data.* FROM users, users_data WHERE users.id = users_data.user_id';
            foreach(json_decode($favorites, true) as $key => $favorite){
                if($key == 0){
                    $query .= " AND (users.id = $favorite";
                    continue;
                }
                $query .= " OR users.id = $favorite";
            }

            $data->favorites = DB::select($query . ')');
        }

        return $data;
    }

    public function getFavorites(){
        $favorites = json_decode(DB::select("SELECT users_data.favorites, users_data.user_id, users.* FROM users_data, users WHERE users.id = users_data.user_id AND users_data.user_id = {$this->id}")[0]->favorites, true);
        return $favorites;
    }

    public function addFavorite($id): void
    {
        $favorites_old = array_values($this->getFavorites());
        $favorites_old[] = (string)$id;
        DB::table('users_data')->where('user_id', $this->id)->update(['favorites' => json_encode($favorites_old)]);
    }

    public function removeFavorite($id): void
    {
        $favorites_old = array_values($this->getFavorites());
        $pos = array_search((string)$id, $favorites_old);
        if($pos !== false){
            unset($favorites_old[$pos]);
        }
        DB::table('users_data')->where('user_id', $this->id)->update(['favorites' => json_encode($favorites_old)]);
    }

    public function getLogs($forMedic=false)
    {
        if($forMedic){
            return DB::select("SELECT logs.*, users.* FROM users, logs WHERE logs.user_id = users.id AND logs.medic_id = {$this->id} ORDER BY date DESC");
        }
        else{
            return DB::table('logs')->where('user_id', $this->id)->orderBy('date', "DESC")->get();
        }
    }

    public function getCertificates($forMedic=false)
    {
        if($forMedic){
            return DB::select("SELECT certificates.*, users.* FROM users, certificates WHERE certificates.user_id = users.id AND certificates.medic_id = {$this->id} ORDER BY date DESC");
        }
        else{
            return Certificate::where('user_id', $this->id)->orderBy('date', "DESC")->get();
        }
    }
}
