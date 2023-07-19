@extends('layouts.app')

@section('content')
<main class="mx-auto w-75 text-center">
            <h2 class="m-2">商品一覧</h2>
            @if (session('flash_massage'))
                <p>{{session('flash_massage')}}</p>
            @endif
            <div class="d-flex justify-content-between py-4">
                @include('modals.search')
                    <a href="#" class="ms-4 link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <div class="d-flex align-items-center">
                            <span class="btn btn-outline-primary">詳細検索</span>
                        </div>
                    </a> 
                <div>
                    <a href="{{ route('pdlist.pd_create')}}" class="btn btn-outline-primary ">新規登録</a>
                </div>
            </div>
            
                <table id="search_table" class="table table-striped align-middle">
                    <tr>
                        <th id='th1'>ID<img src="{{ asset('img/down.svg')}}" class="img-fluid "></th>
                        <th scope="col" style="width:10%">商品画像</th>
                        <th id='th2'>商品名<img src="{{ asset('img/down.svg')}}" class="img-fluid "></th>
                        <th id='th3'>価格<img src="{{ asset('img/down.svg')}}" class="img-fluid "></th>
                        <th id='th4'>在庫数<img src="{{ asset('img/down.svg')}}" class="img-fluid "></th>
                        <th id='th5'>メーカー<img src="{{ asset('img/down.svg')}}" class="img-fluid "></th>
                        <th>詳細表示</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                </table> 
                <div id='search_result'></div>       
        </main>

@endsection
