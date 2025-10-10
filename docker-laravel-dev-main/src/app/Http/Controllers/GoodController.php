<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Stor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $goods=Good::get();
        return view("good",compact("goods"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stors=Stor::get();
        return view("goodCreate",compact("stors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name"=>"required",
            "price"=>"required"
        ],[
            "name.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました"
        ]);
        Good::query()->create([
            "stor_id"=>Auth::user()->id,
            "name"=>$request->name,
            "price"=>$request->price
        ]);
        return redirect(route("good.create"))->with(["message"=>"商品情報が登録されました"]);
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
        $good=Good::find($id);
        $stors=Stor::get();
        return view("goodEdit",compact("good","stors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            "name"=>"required",
            "price"=>"required"
        ],[
            "name.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました"
        ]);
        $good=Good::find($id);
        $good->update([
            "stor_id"=>Auth::user()->id,
            "name"=>$request->name,
            "price"=>$request->price
        ]);
        return redirect(route("good.edit",$good->id))->with(["message"=>"商品情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $a=Good::find($id);
        $a->delete();
        return redirect("good");
    }
}
