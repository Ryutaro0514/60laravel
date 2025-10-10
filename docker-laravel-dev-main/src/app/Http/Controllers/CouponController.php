<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Stor;
use GuzzleHttp\Psr7\Message;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            "couponcode"=>"required",
            "price"=>"required"
        ],[
            "couponcode.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました"
        ]);
        Coupon::query()->create([
            "stor_id"=>Auth::user()->id,
            "couponcode"=>$request->couponcode,
            "price"=>$request->price
        ]);
        return redirect(route("coupon.create"))->with(["message","クーポン情報が作成されました"]);
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
        return view("couponEdit",compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "couponcode"=>"required",
            "price"=>"required"
        ],[
            "couponcode.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました"
        ]);
        $CouponID=Coupon::find($id);
        $CouponID->update([
            "stor_id"=>Auth::user()->id,
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
        return redirect(route("coupon"));
    }
}
