var url_function_shopee = window.location.origin+"/inspect/kompetitor/"+'Cshopee'

function get_data_shopee(url){
    // const url = "https://shopee.co.id/PRINT-HEAD-EPSON-L310-L210-L360-L350-L300-ORIGINAL-i.76552489.7123243429"
    var split_url = url.split('?')[0]
    split_url = split_url.split('.')
    const prod_id = split_url[(split_url.length)-1]
    const shop_id = split_url[(split_url.length)-2]

    if(prod_id === '')
    // const arr_update = {
    //     prod_id : prod_id,
    //     shop_id : shop_id
    // }

    // $.post(url_function_shopee+"/simpan_data_link",arr_update).done(function (resp) {
    //     console.log(resp)
    // })

    get_data_produk_shopee(prod_id,shop_id)

}

function get_data_produk_shopee(url,url_simpan,url_toko){
    var split_url = url.split('?')[0]

    var split_url_new = split_url.split('/')
    var prod_id = split_url_new[5]
    var shop_id = split_url_new[4]
    
    if(typeof prod_id == 'undefined' || typeof shop_id == 'undefined'){
        var split_url_new = split_url.split('.')
        var prod_id = split_url_new[(split_url_new.length)-1]
        var shop_id = split_url_new[(split_url_new.length)-2]
    }

    $("#i-stat-link[data-link='"+url+"']").empty().append('<span class="text-warning">Proses</span>')
    $.get(url_function_shopee+`/get_data_produk_shopee/${prod_id}/${shop_id}`)
    .done(function(resp){
        const data_prod = JSON.parse(resp)
        // console.log(data_prod)
        const d = data_prod['data']
        const nama_prod = d['name']
        const harga = d['price']/100000
        const stok = d['stock']
        const terjual = d['historical_sold']
        const created_time = d['ctime']
        // fungsi simpan ke database
        const arr_post = {
            nama_prod : nama_prod,
            harga : harga,
            stok : stok,
            terjual : terjual,
            url : url,
            shop_id : shop_id,
            created_time : created_time
        }

        // console.log(url_simpan)

        $.post(url_simpan, arr_post).done(function(resp){
            
            $("#i-stat-link-prod[data-link='"+url+"']").empty().append('<span class="text-primary"><i class="fas fa-check"></i></span>')
    
            // lanjut ke fungsi ambil data toko
            get_data_toko_shopee(url, url_toko)

        }).fail(function(resp){
            $("#i-stat-link-prod[data-link='"+url+"']").empty().append('<span class="text-danger"><b>X</b></span>')
            $("#i-stat-link[data-link='"+url+"']").empty().append('<span class="text-danger">Gagal</span>')
        })
    })
    .fail(function(resp){
        $("#i-stat-link-prod[data-link='"+url+"']").empty().append('<span class="text-danger"><b>X</b></span>')
        $("#i-stat-link[data-link='"+url+"']").empty().append('<span class="text-danger">Gagal</span>')
    })
}

function get_data_toko_shopee(url,url_simpan){
    var split_url = url.split('?')[0]

    var split_url_new = split_url.split('/')
    var prod_id = split_url_new[5]
    var shop_id = split_url_new[4]
    
    if(typeof prod_id == 'undefined' || typeof shop_id == 'undefined'){
        var split_url_new = split_url.split('.')
        var prod_id = split_url_new[(split_url_new.length)-1]
        var shop_id = split_url_new[(split_url_new.length)-2]
        // console.log(split_url)
    }

    $.get(url_function_shopee+`/get_data_toko_shopee/${shop_id}`)
    .done(function(resp){
        const data_shop = JSON.parse(resp)
        const d = data_shop['data']
        const nama_toko = d['name']
        const alamat = d['place']
        const asal = d['shop_location']
        const rating_star = d['rating_star']

        // fungsi simpan ke database
        const arr_post = {
            nama_toko : nama_toko,
            alamat : alamat,
            asal : asal,
            rating_star : rating_star,
            shop_id : shop_id
        }

        console.log(arr_post)
        
        $.post(url_simpan, arr_post).done(function(resp){
            $("#i-stat-link-toko[data-link='"+url+"']").empty().append('<span class="text-primary"><i class="fas fa-check"></i></span>')
            $("#i-stat-link[data-link='"+url+"']").empty().append('<span class="text-primary">Selesai</span>')

            cek_selesai_update()
        }).fail(function(resp){
            $("#i-stat-link-toko[data-link='"+url+"']").empty().append('<span class="text-danger"><b>X</b></span>')
            $("#i-stat-link[data-link='"+url+"']").empty().append('<span class="text-danger">Gagal</span>')
        })
    }).fail(function(resp){
        $("#i-stat-link-toko[data-link='"+url+"']").empty().append('<span class="text-danger"><b>X</b></span>')
        $("#i-stat-link[data-link='"+url+"']").empty().append('<span class="text-danger">Gagal</span>')
    })
}