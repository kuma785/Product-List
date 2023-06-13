@extends('layouts.app')

@section('content')
<main class="mx-auto w-75 text-center">
            <h2 class="m-2">商品一覧</h2>
            @if (session('flash_massage'))
                <p>{{session('flash_massage')}}</p>
            @endif
            <div class="d-flex justify-content-between py-4">
                <form method="GET" action="{{ route('pdlist.index')}}">
                    <div class="d-flex justify-content-center">
                        <input type="text" placeholder="商品名で検索" name="product_name"  value="{{ old('product_name')}}">
                        <select name="company_id" value="{{ old('company_id')}}" class="ms-3 fs-7 pe-5 p-2">
                        <option disabled selected value>メーカーで検索</option>
                            @foreach ($companys as $company) 
                                <option>{{$company->company_name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="検索" class="ms-3 btn btn-light btn-sm btn-outline-secondary">
                    </div>
                </form>
                <div>
                    <a href="{{ route('pdlist.pd_create')}}" class="btn btn-outline-primary ">新規登録</a>
                </div>
            </div>
            
                <table class="table table-striped align-middle">
                    <tr>
                        <th>ID</th>
                        <th scope="col" style="width:10%">商品画像</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー</th>
                        <th>詳細表示</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            @if ($product->image)
                            <img src="{{ asset('storage/'.$product->image)}}" class="img-fluid w-75"> 
                             @else
                            <img src="{{ asset('img/none.png')}}" class="img-fluid w-75">
                            @endif
                        </td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->company_id}}</td> 
                        <td><a href="{{ route('pdlist.pd_detail',$product)}}" class="btn btn-light btn-sm">詳細</a></td>
                        <td><a href="{{ route('pdlist.pd_edit',$product)}}" class="btn btn-light btn-sm">編集</a></td>
                        <td>
                            <form action="{{ route('pdlist.delete', $product)}}" method="post" class=deleteAlert>
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-light btn-sm" onclick='return confirm("削除しますか？");'>削除</button> 
                            </form>
                        </td>       
                    </tr>
                    @endforeach
                </table>
                <script src="{{ asset('/js/script.js') }}"></script>
        </main>

@endsection
