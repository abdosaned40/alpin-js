<?php

use App\Events\NewMessageEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/modal', function () {
    return view('modal');
});


Route::get('/chat', [ChatController::class, 'index']);
Route::post('/send-message', [ChatController::class, 'sendMessage']);
