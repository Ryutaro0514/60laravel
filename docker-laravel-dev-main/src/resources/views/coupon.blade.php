@extends('app')
@section('content')
    <h1>クーポン一覧画面</h1>
    <h2><a href="{{ route('coupon.create') }}" class="btn btn-primary">クーポン新規登録</a></h2>
    <h2><a href="{{route("good.index")}}" class="btn btn-primary">商品一覧画面へ</a></h2>
        <a href="{{ route('user.signout') }}" class="btn btn-danger">ログアウト</a>
    <table class="table">
        <tr>
            <th>店舗名</th>
            <th>クーポンコード</th>
            <th>割引価格</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($coupons as $item)
            <tr>
                <td>{{ $item->stor_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->prise }}</td>
                <td><a href="{{ route('coupon.edit', $item->id) }}" class="btn btn-success">編集</a></td>
                <td>
                    <form action="{{route("coupon.delete",$item->id)}}" method="POST">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger" onclick="return confirm('削除してよろしいですか？')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection