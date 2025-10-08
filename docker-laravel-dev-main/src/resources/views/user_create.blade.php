@extends('app')
<h1>サインアップ画面</h1>
<a href="{{ route('user.check') }}" class="btn btn-primary">サインイン画面へ</a>
@section('content')
    <form method="POST" action="{{ route('user.signupStore') }}">
        @csrf
        <input name="name" type="text" placeholder="名前">
        <input name="password" type="password" placeholder="パスワード">
        <button class="btn btn-primary">作成</button>
    </form>
    @if ($errors->any())
        <p class="text-danger">{{ $errors->first() }}</p>
    @endif
@endsection