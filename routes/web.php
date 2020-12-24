<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


#教學用
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{id}', [ArticleController::class, 'show']);
Route::post('articles', [ArticleController::class, 'store']);
Route::put('articles/{id}', [ArticleController::class, 'update']);
Route::delete('articles/{id}', [ArticleController::class, 'destroy']);




#Laravel 7語法(controller@function)
#Laravel 8語法([controller::class, 'function']) 需use namespace

Route::get('hello/{name}',  [HelloController::class, 'showName']);

Route::get('product', [ProductController::class, 'list'])->name('product');

Route::get('user/{userName}', [UserController::class, 'sqlTest']);

Route::get('users/test', [UsersController::class, 'testUsers']);

Route::get('users/account', [UsersController::class, 'testUsersAccount']);