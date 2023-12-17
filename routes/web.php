<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\ChatController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/profile/{user}', [ProfileController::class, 'index'])->where(['user' => '[0-9]+'])->name('profile');


Route::middleware('auth')->group(function(){
    Route::post('/send-message', [ChatController::class, 'send'])->name('message.send');

    Route::get('/profile/edit', [ProfileController::class, 'change_view'])->name('profile.edit');

    Route::post('/profile/edit', [ProfileController::class, 'change']);

    Route::post('/profile/password-change', [ProfileController::class, 'change_password'])->name('profile.edit-password');

    Route::get('/call', [CallController::class, 'index'])->name('call');

    Route::post('/call/create', [CallController::class, 'create']);

    Route::post('/call/answer', [CallController::class, 'answer']);

    Route::post('/call/quit', [CallController::class, 'quit']);
});

require __DIR__.'/auth.php';
