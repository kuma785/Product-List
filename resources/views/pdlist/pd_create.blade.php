@extends('layouts.app')

@section('content')
    <main class="mx-auto w-75 text-center">
        <h2 class="m-2">新規登録</h2>
        @if (session('flash_massage'))
            <p>{{session('flash_massage')}}</p>
        @endif
        <form action="{{route('pdlist.store')}}" method="post">
            @csrf
            <div>
                <label for="product_name" class="mt-2 fs-5">-商品名-</label><br>
                <input type="text" name="product_name"><br>
            </div>
            <div>
                <label for="company_id" class="mt-2 fs-5">-メーカーID-</label><br>
                <input type="text" name="company_id"><br>
            </div>
            <div>
                <label for="price" class="mt-2 fs-5">-価格-</label><br>
                <input type="text" name="price"><br>
            </div>
            <div>
                <label for="stock" class="mt-2 fs-5">-在庫数-</label><br>
                <input type="text" name="stock"><br>
            </div>
            <div>
                <label for="comment" class="mt-2 fs-5">-コメント-</label><br>
                <input type="text" name="comment"><br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('pdlist.store')}}" class="btn btn-outline-primary mt-3 mx-4">戻る</a>
                <button type="submit" class="btn btn-outline-primary mt-3 mx-4">登録</button>
            </div>
        </form>
           
        </main>

@endsection
