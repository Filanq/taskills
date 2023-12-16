<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/call', function () {
    return view('templates.call');
})->name('call');

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');

Route::post('/send-message', [\App\Http\Controllers\ChatController::class, 'send'])->name('message.send');

require __DIR__.'/auth.php';
