<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="addTagModalLabel">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="searchModalLabel">詳細検索</h5>
            </div>
                <form method="post">
                
                    @csrf
                    <div class="d-block text-start ms-3">
                        <label class="fs-5">商品名</label>
                            <input id="s_product_name" type="text" placeholder="商品名で検索" name="s_product_name"  value="{{ old('s_product_name')}}" class="m-1 fs-7 pe-5 p-2"><br>
                        <label class="fs-5">メーカー名</label>
                            <select id="s_company_name" name="s_company_name" value="{{ old('s_company_name')}}" class="m-1 fs-7 pe-5 p-2">
                                <option class="text-muted" selected value=''>メーカーで検索</option>  
                                @foreach ($companys as $company) 
                                    <option>{{$company->company_name}}</option>
                                @endforeach
                            </select><br>
                        <label class="fs-5">価格</label>
                            <input id="price_min" type="int" placeholder="最小" name="price_min" class="m-1 fs-7 p-2 pe-0" >
                            <label class="fs-3">~</label>
                            <input id="price_max" type="int" placeholder="最大" name="price_max" class="m-1 fs-7 p-2 pe-0"><br>
                    
                        <label class="fs-5">在庫数</label>
                            <input id="stock_min" type="int" placeholder="最小" name="stock_min" class="m-1 fs-7 p-2 pe-0" >
                            <label class="fs-3">~</label>
                            <input id="stock_max" type="int" placeholder="最大" name="stock_max" class="m-1 fs-7 p-2 pe-0"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="閉じる">閉じる</button>
                    </div>
                </form>

         </div>
     </div>
 </div>