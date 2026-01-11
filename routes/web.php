<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware(OnlyGuestMiddleware::class);
    Route::post('/login', 'doLogin')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', 'doLogout');
});

Route::prefix('/todos')
    ->controller(TodoController::class)
    ->middleware(OnlyMemberMiddleware::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'addTodo');
        Route::get('/{id}/edit', 'edit');
        Route::patch('/{id}', 'update');
        Route::post('/{id}', 'removeTodo');
    });
