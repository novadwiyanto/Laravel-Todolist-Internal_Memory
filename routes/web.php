<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodolistController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;

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
Route::fallback(function () {
    abort(404);
});

Route::redirect('/', '/home');
Route::view('/home', 'user.home')->middleware(OnlyMemberMiddleware::class);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware(OnlyGuestMiddleware::class);
    Route::post('/login', 'dologin')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', 'dologout')->middleware(OnlyMemberMiddleware::class);
});

Route::controller(TodolistController::class)->group(function () {
    Route::get('/home', 'todolist')->middleware(OnlyMemberMiddleware::class);
    Route::post('/todolist', 'addTodo')->middleware(OnlyMemberMiddleware::class);
    Route::post('/todolist/{id}/delete', 'removeTodo')->middleware(OnlyMemberMiddleware::class);
});