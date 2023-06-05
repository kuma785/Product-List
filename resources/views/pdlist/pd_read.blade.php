@extends('layouts.app')

@section('content')
<main class="mx-auto w-75 text-center">
            <h2 class="m-2">商品一覧</h2>
            @if (session('flash_massage'))
                <p>{{session('flash_massage')}}</p>
            @endif
            <div class="d-flex justify-content-between w- py-4">
                <input type="text" placeholder="商品名で検索">
                <div>
                    <a href="{{ route('pdlist.pd_create')}}" class="btn btn-outline-primary ">新規登録</a>
                </div>
            </div>
            
                <table class="table table-striped">
                    <tr>
                        <th>メーカーID</th>
                        <th>商品画像</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>詳細表示</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->company_id}}</td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        <td><a href="{{ route('pdlist.pd_detail',$product)}}" class="btn btn-light btn-sm">詳細</a></td>
                        <td><a href="{{ route('pdlist.pd_edit',$product)}}" class="btn btn-light btn-sm">編集</a></td>
                        <td>
                            <form action="{{ route('pdlist.delete', $product)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-light btn-sm">削除</button> 
                            </form>
                        </td>       
                    </tr>
                    @endforeach
                </table>
        </main>

@endsection
