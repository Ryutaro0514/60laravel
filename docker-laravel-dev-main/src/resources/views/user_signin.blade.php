@extends('app')
@section('content')
<h1>サインイン画面</h1>
<a href="{{route("user.signupStore")}}" class="btn btn-primary">サインアップ画面へ</a>
    <form method="POST" action="{{route("user.check")}}">
        @csrf
        <input name="name" type="text" placeholder="名前">
        <input name="password" type="password" placeholder="パスワード">
        <button class="btn btn-primary">サインイン</button>
        @if (session("message"))
            <div class="alert alert-danger">{{session("message")}}</div>
        @endif

    </form>
@endsection