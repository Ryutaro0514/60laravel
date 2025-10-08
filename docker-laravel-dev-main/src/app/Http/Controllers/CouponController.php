<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Stor;
use GuzzleHttp\Psr7\Message;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $coupons=Coupon::get();
        return view("coupon",compact("coupons"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $coupons=Coupon::get();
        return view("couponCreate",compact("coupons"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "stor_id"=>"required",
            "couponcode"=>"required",
            "price"=>"required"
        ],[
            "stor_id.required"=>"店舗情報がありません",
            "couponcode.required"=>"クーポン情報がありません",
            "price.required"=>"金額情報がありません"
        ]);
        Coupon::query()->create([
            "stor_id"=>$request->stor_id,
            "couponcode"=>$request->couponcode,
            "price"=>$request->price
        ]);
        return redirect(route("couponCreate"))->with(["message","クーポン情報が更新されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $coupon=Coupon::find($id);
        return view("couponEdit",compact("coupon,stors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "stor_id"=>"required",
            "couponcode"=>"required",
            "price"=>"required"
        ],[
            "stor_id.required"=>"エラーが発生しました",
            "couponcode.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました"
        ]);
        Coupon::query()->update([
            "stor_id"=>$request->stor_id,
            "couponcode"=>$request->couponcode,
            "price"=>$request->price
        ]);
        return redirect(route("coupon.edit",$id))->with(["message","クーポン情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $event=Event::find($id);
        $event->delete();
        return redirect(route("coupon.index"));
    }
}
