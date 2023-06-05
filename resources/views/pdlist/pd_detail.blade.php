@extends('layouts.app')

@section('content')
    <main class="mx-auto w-75 text-center">
        <h2 class="m-2">商品詳細</h2>
        @if (session('flash_massage'))
            <p>{{session('flash_massage')}}</p>
        @endif

        <form action="{{route('pdlist.store')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="product_name" class="mt-2 fs-5">-商品名-</label>
                <p>{{$product->product_name}}</p>
            </div>
            <div>
                <label for="company_id" class="mt-2 fs-5">-メーカーID-</label>
                <p>{{$product->company_id}}</p>
            </div>
            <div>
                <label for="price" class="mt-2 fs-5">-価格-</label>
                <p>{{$product->price}}</p>
            </div>
            <div>
                <label for="stock" class="mt-2 fs-5">-在庫数-</label>
                <p>{{$product->stock}}</p>
            </div>
            <div>
                <label for="comment" class="mt-2 fs-5">-コメント-</label>
                <p>{{$product->comment}}</p>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('pdlist.store')}}" class="btn btn-outline-primary mt-3 mx-4">戻る</a>
                <a href="{{route('pdlist.pd_edit',$product)}}" class="btn btn-outline-primary mt-3 mx-4">編集</a>
                <form action="{{ route('pdlist.delete', $product)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger mt-3 mx-4">削除</button> 
                </form>  
            </div>
        </form>
           
        </main>

@endsection