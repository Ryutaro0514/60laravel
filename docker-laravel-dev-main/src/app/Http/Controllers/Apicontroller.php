<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Good;
use App\Models\Reserv;
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

    public function getGood()
    {

        $getGood = Good::get();
        $goods = [];
        foreach ($getGood as $item) {
            $goods[] = [
                'stor_id' => $item->stor_id,
                'name' => $item->name,
                'price' => $item->price,
            ];
        }
        return response()->json($goods, 200);
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
                "stor_id" => $item->shop_id,
                "price" => $item->price,
                "name" => $item->name
            ];
        }
        return response()->json($result, 200);
    }

    public function PostOrder(Request $request)
    {
        if (!$request->good_id) {
            return response()->json(["error" => "エラーが発生しました"]);
        }
        if (!$request->address) {
            return response()->json(["error" => "エラーが発生しました"]);
        }
        if (!$request->price) {
            return response()->json(["error" => "エラーが発生しました"]);
        }
        if ($request->couponcode) {
            $coupon = Coupon::query()->where("couponcode", $request->couponcode)->first();
            if (!$coupon) {
                return response()->json(["error" => "エラーが発生しました"]);
            } else {
                $price = $request->price - $coupon->price;
                Reserv::query()->create([
                    "good_id" => $request->good_id,
                    "couponcode" => $request->couponcode,
                    "address" => $request->address,
                    "price" => $price
                ]);
            }
        } else {
            Reserv::query()->create([
                "good_id" => $request->good_id,
                "couponcode" => null,
                "address" => $request->address,
                "price" => $request->price
            ]);
        }

        return response()->json(["success" => true], 200);
    }
}
