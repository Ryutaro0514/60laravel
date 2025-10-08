<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Stor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Apicontroller extends Controller
{
    //
    public function checkUser($name, $password)
    {
        $user = User::where("name", $name)->first();
        if ($user && Hash::check($password, $user->password)) {
            return true;
        }
        return false;
    }

        public function getApi(Request $request)
    {
        $check = $this->checkUser($request->name, $request->password);
        if ($check) {
            $good = Good::get();
            return response()->json($good);
        }
        return response()->json(["エラー" => "そのアカウントは登録されていません"]);
    }

    public function getGood(Request $request)
    {
        $check = $this->checkUser($request->name, $request->password);
        if ($check) {
        $getGood = Good::get();
        $goods = [];
        foreach ($getGood as $item) {
            $goods = [
                "stor_id"=>$item->stor_id,
                "name"=>$item->name,
                "price"=>$item->price
            ];
        };
        return response()->json($goods, 200);
        };
    }
        public function getDoodNarrow(Request $request)
    {
        $goods = Good::query();
        if ($request->description) {
            $goods->where("stor_id", "=", $request->shop_id);
        }
        if ($request->description) {
            $goods->where("price", "=", $request->price);
        }
        if ($request->name) {
            $goods->where("name", "LIKE", "%" . $request->name . "%");
        }
        $result = [];
        foreach ($goods as $item) {
            $result[] = [
                "stor_id"=>$request->shop_id,
                "price"=>$request->price,
                "name"=>$request->name
            ];
        }
        return response()->json($result, 200);
    }
}
