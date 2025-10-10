@extends('app')
@section('content')
<a href="{{route("coupon.index")}}" class="btn btn-primary">戻る</a>
    <form action="{{route("coupon.update",$coupon->id)}}" method="post">
        @csrf
        <input type="text" placeholder="クーポンコード" name="couponcode">
        <input type="number" placeholder="割引価格" name="price">
        <button class="btn btn-primary">登録</button>
    </form>
    @if ($errors->any())
        <p class="text-danger">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p>{{session("message")}}</p>
    @endif
@endsection