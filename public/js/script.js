$sortkey = 'id';
$sortby = 'asc';
//検索機能Ajax
function search(){
        var data = {
            'name' : $('#s_product_name').val(),
            'id' : $('#s_company_id').val(),
            'price_min' : $('#price_min').val(),
            'price_max' : $('#price_max').val(),
            'stock_min' : $('#stock_min').val(),
            'stock_max' : $('#stock_max').val(), 
            'sortkey' : $sortkey,
            'sortby' : $sortby
        };
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'POST',
            async: true,
            timeout: 10000,
            url:'pdlist/search',
            datatype: 'json',
            data: data
    
        }).done(function (resp){
            var list = JSON.parse(resp);
            $('.search_td').empty();
            $('#search_result').empty();

            if(list.length==0){
                $('#search_result').html(
                    "<h3>該当のデータはありません</h3>"
                )
            }else{
                listUp(list);
                history.pushState({ page : $('list').html() }, null, ""); 
            };
            console.log(data);
            return false;

        }).fail(function(jqXHR, textStatus, errorThrown){
            console.log('ファイルの取得に失敗しました。');
                        console.log("ajax通信に失敗しました");
                        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
                        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
                        console.log("errorThrown    : " + errorThrown.message); // 例外情報
                        console.log("URL            : " + url);
        }).always(function() {

        });
};

function listUp(list){
    for(i=0; i<list.length;i++){
        let image = "../public/storage/"+list[i].image
        $('#search_table').append(
            "<tr class='search_td'><td>"+list[i].id+"</td>"+
            "<td><img id='img"+list[i].id+"' src='"+image+"' class='img-fluid w-75'</td>"+
            "<td>"+list[i].product_name+"</td>"+
            "<td>"+list[i].price+"</td>"+
            "<td>"+list[i].stock+"</td>"+
            "<td>"+list[i].company_id+"</td>"+
            "<td><button id='detailbtn' name='"+list[i].id+"' class='btn btn-light btn-sm'>詳細</button></td>"+
            "<td><button id='editbtn' name='"+list[i].id+"' class='btn btn-light btn-sm'>編集</button></td>"+
            "<td><input type='button' id='delbtn' name='"+list[i].id+"' class='btn btn-light btn-sm' value='削除'></td></tr>"
        )
    };         
};

//詳細ページへ
$(document).on('click','#detailbtn',function(){
    let detnum = $(this).attr('name');
    window.location.href = 'http://localhost/laravel-product-list-app/public/pdlist/'+detnum
});

//編集ページへ
$(document).on('click','#editbtn',function(){
    let editnum = $(this).attr('name');
    window.location.href = 'http://localhost/laravel-product-list-app/public/pdlist/'+editnum+'/edit'
});

//削除機能
$(document).on('click','#delbtn',function(){
    let delnum = $(this).attr('name');
    if(!confirm('ID : '+delnum+' の商品情報を削除しますか？')){
        return false;
    }else{
        let id = '#img'+delnum;
        let imgpass = $(id).attr('src').substring(17);
        var data = {
            'delnum':delnum,
            'imgpass': imgpass,
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'POST',
            async: true,
            timeout: 10000,
            url:'pdlist/delete',
            datatype: 'json',
            data: data

        }).done(function (){
            search();
            return false;

        }).fail(function(jqXHR, textStatus, errorThrown){
            console.log('ファイルの取得に失敗しました。');
                        console.log("ajax通信に失敗しました");
                        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
                        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
                        console.log("errorThrown    : " + errorThrown.message); // 例外情報
                        console.log("URL            : " + url);
        }).always(function() {

        });
        
    } 
});



//検索アクション

$(function(){
    $("#s_product_name").on("input",function(){
        search();
    });
});

$(function(){
    $("#s_company_id").on("input",function(){
        search();
    });
});

$(function(){
    $("#price_min").on("input",function(){
        search();
    });
});

$(function(){
    $("#price_max").on("input",function(){
        search();
    });
});

$(function(){
    $("#stock_min").on("input",function(){
        search();
    });
});

$(function(){
    $("#stock_max").on("input",function(){
        search();
    });
});

//ソート機能
$th1 = 1;
$th2 = 0;
$th3 = 0;
$th4 = 0;
$th5 = 0;
$th6 = 0;

function sort(){
    if($count%2==0){
        $($sortimg).children('img').attr('src',"../public/img/down.svg");
        $sortby = 'asc';
    }else{
        $($sortimg).children('img').attr('src',"../public/img/up.svg");
        $sortby = 'desc';
    };
    search();
};


$(document).on('click','#th1',function(){
    $count = $th1++;
    $sortimg = '#th1';
    $sortkey = 'id';
    sort();   
});

$(document).on('click','#th2',function(){
    $count = $th2++;
    $sortimg = '#th2';
    $sortkey = 'product_name';
    sort();
});

$(document).on('click','#th3',function(){
    $count = $th3++;
    $sortimg = '#th3';
    $sortkey = 'price';
    sort();
});

$(document).on('click','#th4',function(){
    $count = $th4++;
    $sortimg = '#th4';
    $sortkey = 'stock';
    sort();
});

$(document).on('click','#th5',function(){
    $count = $th5++;
    $sortimg = '#th5';
    $sortkey = 'company_id';
    sort();
});

