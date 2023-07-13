@extends('layouts.app')

@section('content')
    <main class="mx-auto w-75 text-center">
        <h2 class="m-2">商品リスト更新</h2>
        @if ($errors->any())
            <div>
                <ul class="list-unstyled text-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('pdlist.update',$product)}}" method="post" action="/upload" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div  class="d-flex justify-content-center ">
                <div class="w-25 my-5 me-5">
                    @if ($product->image)
                    <img src="{{ asset('storage/'.$product->image)}}" class="img-fluid"> 
                    @else
                    <img src="{{ asset('img/none.png')}}" class="img-fluid">
                    @endif
                    <div>
                        <label for="image" class="mt-2 fs-5">-画像のファイル-</label><br>
                        <div class="d-flex justify-content-center p-2">
                            <div>
                                <input type="radio" name="contact" value="1" @if(old('contact')==1) checked @endif><label for="change">変更する</label>
                            </div>
                            <div>
                                <input type="radio" name="contact" value="2" @if(old('contact')==2) checked @endif><label for="stay">変更しない</label>
                            </div>
                        </div>
                        <input type="file" name="image" class="@error('image') error @enderror"><br>
                        
                    </div>
                    
                </div>

                <div>
                    <div>
                        <label for="product_name" class="mt-2 fs-5">-商品名-</label><br>
                        <input type="text" name="product_name" value="{{ old('product_name',$product->product_name)}}"><br>
                    </div>
                    <div>
                        <label for="company_id" class="mt-2 fs-5">-メーカーID-</label><br>
                        <select id="company_id" name="company_id" class="mt-2 fs-7 pe-5 pt-1">
                        <option value="">選択してください</option>
                            @foreach ($companys as $company) 
                                <option value="{{$company->company_name}}" @if(old('company_id',$product->company_id) == $company->company_name) selected @endif>{{$company->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price" class="mt-2 fs-5">-価格-</label><br>
                        <input type="text" name="price" value="{{ old('price',$product->price)}}"><br>
                    </div>
                    <div>
                        <label for="stock" class="mt-2 fs-5">-在庫数-</label><br>
                        <input type="text" name="stock" value="{{ old('stock',$product->stock)}}"><br>
                    </div>
                    <div>
                        <label for="comment" class="mt-2 fs-5">-コメント-</label><br>
                        <input type="text" name="comment" value="{{ old('comment',$product->comment)}}"><br>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="javascript:history.back();" class="btn btn-outline-primary mt-3 mx-4">戻る</a>
                <button type="submit" class="btn btn-outline-primary mt-3 mx-4">更新</button>
            </div>
        </form>  
        </main>

@endsection