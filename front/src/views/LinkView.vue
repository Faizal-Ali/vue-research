<template>
    <Sidebar/>

    <div class="main-content" style="overflow-y:auto">
    <section class="section">
        <div class="section-header">
            <h1 class="w-100">
                Link
                <a href="http://localhost/research/back/up_link" target="_blank" class="btn btn-warning float-right ml-2">Update</a>
                <router-link class="btn-success btn float-right" to="/linkTambah">Tambah</router-link>
            </h1>
        </div>

        <div class="section-body bg-white shadow-sm p-2">
            <div id="parent-table-horizontal" style="overflow-x:auto;max-height:66vh;min-height: 66vh;">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">No</th>
                            <th class="bg-primary text-center text-white sticky-first-tr width-group-2" rowspan="2">Ecom</th>
                            <th class="bg-primary text-center text-white sticky-first-tr width-group-2" rowspan="2">Nama Toko</th>
                            <th class="bg-primary text-center text-white sticky-first-tr width-group-2" rowspan="2">Lokasi Toko</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" colspan="2">Total</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" colspan="4">
                                Tanggal
                            </th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2" colspan="3">Aksi</th>
                        </tr>
                        <tr>
                            <!-- all -->
                            <th class="bg-primary text-center text-white sticky-second-tr">Terjual &nbsp<span data-toggle="tooltip" data-title="Produk terjual keseluruhan"><i class="fas fa-question-circle"></i></span></th>
                            <th class="bg-primary text-center text-white sticky-second-tr">Omset &nbsp<span data-toggle="tooltip" data-title="Total omset keseluruhan"><i class="fas fa-question-circle"></i></span></th>

                            <!-- sesuai tanggal -->
                            <th class="bg-primary text-center text-white sticky-second-tr">
                                Stok &nbsp<span data-toggle="tooltip" data-title="Status stok pada <?=date('d M y',strtotime($tgl_pilih))?>"><i class="fas fa-question-circle"></i></span>
                            </th>
                            <th class="bg-primary text-center text-white sticky-second-tr">
                                Harga &nbsp<span data-toggle="tooltip" data-title="Harga produk pada <?=date('d M y',strtotime($tgl_pilih))?>"><i class="fas fa-question-circle"></i></span>
                            </th>
                            <th class="bg-primary text-center text-white sticky-second-tr">
                                Terjual &nbsp<span data-toggle="tooltip" data-title="Produk terjual pada <?=date('d M y',strtotime($tgl_pilih))?>"><i class="fas fa-question-circle"></i></span>
                            </th>
                            <th class="bg-primary text-center text-white sticky-second-tr">
                                Omset &nbsp<span data-toggle="tooltip" data-title="Total omset pada <?=date('d M y',strtotime($tgl_pilih))?>"><i class="fas fa-question-circle"></i></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(l, index) in dlink">
                            <td>{{ index+1 }}</td>
                            <td>{{ l.ecom }}</td>
                            <td>{{ l.nama_produk }}</td>
                            <td>{{ l.link }}</td>
                            <td>{{ l.total_terjual }}</td>
                            <td>{{ l.total_omset }}</td>
                            <td>{{ l.stok }}</td>
                            <td>{{ l.harga }}</td>
                            <td>{{ l.terjual_now }}</td>
                            <td>{{ l.omset_now }}</td>
                            <td>
                                <router-link :to="{name: 'linkEdit', params: { id_link: l.id }}" class="btn btn-warning">Edit</router-link>
                                <button class="btn btn-danger" v-on:click="hapusLink(l.id)">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <!-- <?=$paging?> -->
        </div>
    </section>
  </div>
</template>

<script>
// @ is an alias to /src
import Sidebar from '@/components/Sidebar.vue'
import axios from 'axios'

const head_form = {headers: {'Content-Type': 'multipart/form-data'}}

export default {
  name: 'HomeView',
  components: {
    Sidebar
  },
  data() {
    return {
        dlink : [],
    }
  },
  created() {
    axios.defaults.baseURL = 'http://localhost/research/back/clink',
    this.getDlink()
  },
  methods: {
    getDlink : function(){
        axios.get('view')
             .then(response => (
                this.dlink = response.data.data
                // console.log(response.data.data)
             ))
             .catch(error => alert(error));
    },
    hapusLink : function(e){
        axios.get(`delete?id=${e}`)
             .then(response => (
                this.getDlink()
             ))
        .catch(error => alert(error));
    }
  },
}
</script>

<style scoped>
    .sticky-second-tr{
        top:40px !important;
        position: sticky;
    }
</style>
