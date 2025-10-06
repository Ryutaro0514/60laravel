<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/signup', [UserController::class,"create"])->name("user.signupCreate");
Route::post('/signup', [UserController::class,"store"])->name("user.signupStore");
Route::get('/signin',[LoginController::class,"signin"])->name("login");
Route::post('/signin',[LoginController::class,"check"])->name("user.check");
Route::middleware(["auth", "cache.headers:no_store;max_age=0"])->group(function(){

});