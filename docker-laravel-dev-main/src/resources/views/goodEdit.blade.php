@extends('app')
@section('content')
<a href="{{route("good.index")}}" class="btn btn-primary">戻る</a>
    <form action="{{route("good.update",$good->id)}}" method="post">
        @csrf
        <input type="text" placeholder="商品名" name="name">
        <input type="number" placeholder="税込価格" name="price">
        <button class="btn btn-primary">登録</button>
    </form>
    @if ($errors->any())
        <p class="text-danger">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p>{{session("message")}}</p>
    @endif
@endsection