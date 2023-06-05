@extends('layouts.app')

@section('content')
    <main class="mx-auto w-75 text-center">
        <h2 class="m-2">商品リスト更新</h2>
        <form action="{{route('pdlist.update',$product)}}" method="post">
            @csrf
            @method('patch')
            <div>
                <label for="product_name" class="mt-2 fs-5">-商品名-</label><br>
                <input type="text" name="product_name" value="{{$product->product_name}}"><br>
            </div>
            <div>
                <label for="company_id" class="mt-2 fs-5">-メーカーID-</label><br>
                <input type="text" name="company_id" value="{{$product->company_id}}"><br>
            </div>
            <div>
                <label for="price" class="mt-2 fs-5">-価格-</label><br>
                <input type="text" name="price" value="{{$product->price}}"><br>
            </div>
            <div>
                <label for="stock" class="mt-2 fs-5">-在庫数-</label><br>
                <input type="text" name="stock" value="{{$product->stock}}"><br>
            </div>
            <div>
                <label for="comment" class="mt-2 fs-5">-コメント-</label><br>
                <input type="text" name="comment" value="{{$product->comment}}"><br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('pdlist.store')}}" class="btn btn-outline-primary mt-3 mx-4">戻る</a>
                <button type="submit" class="btn btn-outline-primary mt-3 mx-4">更新</button>
                <form action="{{ route('pdlist.delete', $product)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger mt-3 mx-4">削除</button> 
                </form>
            </div>
        </form>
           
        </main>

@endsection