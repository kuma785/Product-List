@extends('layouts.app')

@section('content')
    <main class="mx-auto w-75 text-center">
        <h2 class="m-2">新規登録</h2>
        @if ($errors->any())
            <div>
                <ul class="list-unstyled text-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('flash_massage'))
            <p>{{session('flash_massage')}}</p>
        @endif
        <form action="{{route('pdlist.store')}}" method="post" action="/upload" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="product_name" class="mt-2 fs-5">-商品名-</label><br>
                <input type="text" name="product_name" value="{{ old('product_name')}}"><br>
            </div>
            <div>
                <label for="company_name" class="mt-2 fs-5">-メーカー名-</label><br>
                <select id="company_name" name="company_name" class="mt-2 fs-7 pe-5 pt-1">
                    <option value="">選択してください</option>
                        @foreach ($companys as $company) 
                            <option @if(old('company_name') == $company->company_name) selected @endif>{{$company->company_name}}</option>
                        @endforeach
                </select>
            </div>
            <div>
                <label for="price" class="mt-2 fs-5">-価格-</label><br>
                <input type="text" name="price" value="{{ old('price')}}"><br>
            </div>
            <div>
                <label for="stock" class="mt-2 fs-5">-在庫数-</label><br>
                <input type="text" name="stock" value="{{ old('stock')}}"><br>
            </div>
            <div>
                <label for="comment" class="mt-2 fs-5">-コメント-</label><br>
                <input type="text" name="comment" value="{{ old('comment')}}"><br>
            </div>
            <div>
                <label for="image" class="mt-2 fs-5">-画像-</label><br>
                <div class="d-none">
                            <div>
                                <input type="radio" value="1" name="contact" checked><label for="change">変更する</label>
                            </div>
                            <div>
                                <input type="radio" value="2" name="contact"><label for="stay">変更しない</label>
                            </div>
                        </div>
                <input type="file" name="image"><br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('pdlist.store')}}" class="btn btn-outline-primary mt-3 mx-4">戻る</a>
                <button type="submit" class="btn btn-outline-primary mt-3 mx-4">登録</button>
            </div>
        </form>
           
        </main>

@endsection
