<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.auth', ['active' => 'register']);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'surname' => ['required', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:8', 'max:255'],
        ], [
            'firstname.required' => 'Введите имя!',
            'firstname.max' => 'Ваше имя превысило лимит!',
            'surname.required' => 'Введите фамилию!',
            'surname.max' => 'Ваша фамилия превысила лимит!',
            'email.required' => 'Введите email!',
            'email.email' => 'Ваша почта не соответствует стандартам!',
            'email.max' => 'Ваша почта превысила лимит!',
            'email.unique' => 'Аккаунт для этой почты уже существует!',
            'password.required' => 'Введите пароль!',
            'password.min' => 'Ваш пароль должен быть не меньше 8 символов!',
            'password.max' => 'Ваш пароль превысил лимит!',
        ]);

        if($request->input('password_confirm') !== $request->input('password')){
            throw ValidationException::withMessages([
                'password_confirm' => 'Пароли должны совпадать!'
            ]);
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->input('status')
        ]);
        DB::table('users_data')->insert([
            "user_id" => $user->id,
            "avatar" => "avatar.svg",
            "favorites" => "[]"
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }
}
