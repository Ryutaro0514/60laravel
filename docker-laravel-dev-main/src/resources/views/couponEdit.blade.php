@extends('app')
@section('content')
<a href="{{route("coupon.index")}}" class="btn btn-primary">戻る</a>
    <form action="{{route("coupon.update",$good->id)}}" method="post">
        @csrf
        @method("patch")
        <select name="stor_id" id="">
            @foreach ($stors as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        <input type="text" placeholder="クーポンコード" name="name">
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