@extends('layouts.app')

@section('content')
    <main class="mx-auto w-75 text-center">
        <h2 class="m-2">商品詳細</h2>
        @if (session('flash_massage'))
            <p>{{session('flash_massage')}}</p>
        @endif
        <div  class="d-flex justify-content-center ">
            <div class="w-25 my-5 me-5">
                <img src="{{asset('img/product.png')}}" class="img-fluid"> 
            </div>
            <div class="w-25">
                @csrf
                <div class="form-group mb-3">
                    <label for="product_name" class="mt-4 fs-5">-商品名-</label>
                    <p>{{$product->product_name}}</p>
                </div>
                <div>
                    <label for="company_id" class="mt-1 fs-5">-メーカー名-</label>
                    <p>{{$product->company_id}}</p>
                </div>
                <div>
                    <label for="price" class="mt-1 fs-5">-価格-</label>
                    <p>{{$product->price}}</p>
                </div>
                <div>
                    <label for="stock" class="mt-1 fs-5">-在庫数-</label>
                    <p>{{$product->stock}}</p>
                </div>
                <div>
                    <label for="comment" class="mt-1 fs-5">-コメント-</label>
                    <p>{{$product->comment}}</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
                    <a href="{{route('pdlist.store')}}" class="btn btn-outline-primary mt-3 mx-4">戻る</a>
                    <a href="{{route('pdlist.pd_edit',$product)}}" class="btn btn-outline-primary mt-3 mx-4">編集</a>
                    <form action="{{ route('pdlist.delete', $product)}}" method="post" class=deleteAlert>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger mt-3 mx-4">削除</button> 
                    </form>  
                </div>
        <script src="{{ asset('/js/script.js') }}"></script>
        </main>

@endsection