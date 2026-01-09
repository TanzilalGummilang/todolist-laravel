<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware(OnlyGuestMiddleware::class);
    Route::post('/login', 'doLogin')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', 'doLogout');
});

Route::controller(TodoController::class)
    ->middleware(OnlyMemberMiddleware::class)->group(function () {
        Route::get('/todos', 'index');
        Route::post('/todos', 'addTodo');
        Route::post('/todos/{id}', 'removeTodo');
    });
