<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<style>
    .hide{
        display: none;
    }

    .vertical-middle{
        vertical-align: middle !important;
    }
</style>

<div class="p-4 hide" id="table-update">
    <!-- <h2>Update data link</h2>
    <div id='log'></div>
    <div id='log2'></div> -->
    <h4 class="text-center text-primary">Proses Update</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center bg-primary text-white vertical-middle" >No</th>
                <th class="text-center bg-primary text-white vertical-middle" >Link</th>
                <th class="text-center bg-primary text-white vertical-middle" >Data Produk</th>
                <th class="text-center bg-primary text-white vertical-middle" >Data Toko</th>
                <th class="text-center bg-primary text-white vertical-middle" >Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($list_link as $ll) {
            ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$ll['link']?></td>
                    <td class="text-center" data-link="<?=$ll['link']?>" id="i-stat-link-prod"><i class="fas fa-minus text-warning"></i></td>
                    <td class="text-center" data-link="<?=$ll['link']?>" id="i-stat-link-toko"><i class="fas fa-minus text-warning"></i></td>
                    <td class="text-center" data-link="<?=$ll['link']?>" id="i-stat-link"><span class="text-warning">Pending</span></td>
                </tr>
            <?php
                }

                $list_link = json_encode($list_link);
            ?>
        </tbody>
    </table>
</div>

<div>
    <div class="modal fade" id="modal_connecting" data-backdrop="static" data-dismiss="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body card" style="background-color: #f1f2f3;">
                    <div class="text-center">
                        <h4>Menghubungkan ke server</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://localhost/research/back/assets/js/getShopee.js"></script>
<script src="http://localhost/research/back/assets/js/getTokopedia.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        get_server()
    })

    const arr_data = <?=$list_link?>;
    const total   = arr_data.length;
    const list_data_connect = <?=$list_connect?>;
    const total_connect = list_data_connect.length;
    const jumlah_data = total+total_connect;
    var index_awal = 0;
    var terupdate = 0;
    var urlKe   = parseInt(<?=$this->uri->segment(2)?$this->uri->segment(2):1?>)+1;
    const url_simpan_shopee = "http://localhost/research/back/kompetitor/Cshopee/simpan_data_produk";
    const url_simpan_tokopedia = "http://localhost/research/back/kompetitor/Ctokopedia/simpan_data_produk";
    const url_simpan_shopee_toko = "http://localhost/research/back/kompetitor/Cshopee/simpan_data_toko";
    const url_simpan_tokopedia_toko = "http://localhost/research/back/kompetitor/Ctokopedia/simpan_data_toko";

    function simpan(ke){
        if(total >0){
            if(ke <= total){
                const d = arr_data[ke-1]
                const ecom = d['ecom']
                const link = d['link']

                if(ecom == 'tokopedia'){
                    get_data_produk_tokopedia(link,url_simpan_tokopedia,url_simpan_tokopedia_toko)
                }else if (ecom == 'shopee'){
                    get_data_produk_shopee(link,url_simpan_shopee,url_simpan_shopee_toko)
                }
            }
        }
    }
    
    function get_server(){
        $('#modal_connecting').modal('show')

        $.each(list_data_connect,function(i,d){
            const ecom = d['ecom']
            const link = d['link']

            if(ecom == 'tokopedia'){
                console.log('tokopedia')
                get_data_produk_tokopedia(link,url_simpan_tokopedia,url_simpan_tokopedia_toko)
            }else if (ecom == 'shopee'){
                console.log('shopee')
                get_data_produk_shopee(link,url_simpan_shopee,url_simpan_shopee_toko)
            }
        })
    }

    function cek_selesai_update (){
        terupdate++

        if(terupdate == 2){
            setTimeout(() => {
                $('#modal_connecting').modal('hide')
    
                $('#table-update').show()
            }, 3000);

            simpan(index_awal)
        }

        if(terupdate >= jumlah_data){
            // window.close()
            // window.location = "<?=base_url('indikator-barang_index-update_link')?>"
            // setTimeout(() => {
            //     window.location="http://localhost/research/back/up_link/"+urlKe;
            // }, 1000);
            alert('update selesai')
        }else{
            setTimeout(() => {
                index_awal++;
                simpan(index_awal);
            }, 1000);
        }
    }
</script>