<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function signin(){
        return view("user_signin");
    }
    public function check(Request $request){
        $user=$request->only("name","password");
        if(Auth::attempt($user)){
            $request->session()->regenerate();
            return redirect(route("good.index"));
        }
        return back()->with(["message","アカウントまたはパスワードが違います"]);
    }
    public function signout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect(route("user.signupCreate"));
    }
}
