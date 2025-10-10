<?php

use App\Http\Controllers\Apicontroller;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\Coupon;
use Illuminate\Support\Facades\Route;


Route::get('/signin',[LoginController::class,"signin"])->name("login");
Route::post('/signin',[LoginController::class,"check"])->name("user.check");
Route::get('/signup', [UserController::class,"create"])->name("user.signupCreate");
Route::post('/signup', [UserController::class,"store"])->name("user.signupStore");
Route::middleware(["auth", "cache.headers:no_store;max_age=0"])->group(function(){
    Route::get("/good",[GoodController::class,"index"])->name("good.index");
    Route::get("/good/create",[GoodController::class,"create"])->name("good.create");
    Route::post("/good/create",[GoodController::class,"store"])->name("good.store");
    Route::get("/good/edit/{id}",[GoodController::class,"edit"])->name("good.edit");
    Route::post("/good/edit/{id}",[GoodController::class,"update"])->name("good.update");
    Route::delete("/good/{id}",[GoodController::class,"destroy"])->name("good.delete");
    Route::get('/signout',[LoginController::class,"signout"])->name("user.signout");

    Route::get("/coupon",[CouponController::class,"index"])->name("coupon.index");
    Route::get("/coupon/create",[CouponController::class,"create"])->name("coupon.create");
    Route::post("/coupon/create",[CouponController::class,"store"])->name("coupon.store");
    Route::get("/coupon/edit/{id}",[CouponController::class,"edit"])->name("coupon.edit");
    Route::post("/coupon/edit/{id}",[CouponController::class,"update"])->name("coupon.update");
    Route::delete("/coupon/{id}",[CouponController::class,"destroy"])->name("coupon.delete");



    Route::get('/signout',[LoginController::class,"signout"])->name("user.signout");
});