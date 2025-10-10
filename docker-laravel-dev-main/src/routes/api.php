<?php

use App\Http\Controllers\Apicontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 Route::get('/items', [Apicontroller::class, 'getGood']);
 Route::post("/order",[Apicontroller::class,"PostOrder"]);