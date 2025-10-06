<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create(){
        return view("user_create");
    }
    public function store(Request $request){
        $request->validate([
            "name"=>"required",
            "passwors"=>"required"
        ],[
            "name.required"=>"名前が入力されていません",
            "password.required"=>"パスワードが入力されていません"
        ]);
        User::query()->create([
            "name"=>$request->name,
            "password"=>$request->password
        ]);
        return redirect(route("login"));
    }
}
