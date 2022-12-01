<template>
    <Sidebar/>
    <div class="main-content" style="overflow-y:auto">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Link</h1>
            </div>
            <div class="section-body">
                <div class="bg-white mx-auto rounded shadow-sm col-md-12 p-4">
                    <form ref="formEdit">
                        <span>Nama Produk</span>
                        <input v-model="id_link" id="id_link" type="hidden" class="col-md-12 form-control">
                        <input v-model="nama_produk" id="nama_produk" type="text" class="col-md-12 form-control">

                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <span>Link Produk</span>
                                <input v-model="link" type="text" class="col-md-12 form-control" id="link_produk">
                            </div>
                            <div class="col-md-2">
                                <span>Jenis Ecom</span>
                                <select class="form-control" v-model="ecom"  name="" id="">
                                    <option value="">PIlih Ecom</option>
                                    <option value="shopee">Shopee</option>
                                    <option value="tokopedia">Tokopedia</option>
                                </select>
                            </div>
                        </div>
                        <br>                    
                    <div class="d-flex justify-content-between mt-2 p-2">
                        <router-link class="btn-warning btn col-md-5" to="/link">Kembali</router-link>
                        <button type="button" v-on:click="setDataUpdate()" class="btn-primary btn col-md-5" id="btn-simpan"><span style="font-size:16px">Simpan</span></button>
                    
                    </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

</template>
<script>
import Sidebar from '@/components/Sidebar.vue'
import axios from 'axios'

const head_form = {headers: {'Content-Type': 'multipart/form-data'}}

export default {
  name: 'LinkTambahView',
  components: {
    Sidebar
  },
  data() {
    return {
        link : "",
        ecom : "",
        nama_produk : "",
        id_link : ""
    }
  },
  created() {
    this.getDataLink(),
    axios.defaults.baseURL = 'http://localhost/research/back/clink'
  },
  methods: {
    getDataLink : function(){
        axios.get(`get_update?id=${this.$route.params.id_link}`)
             .then(response => (
                this.link =response.data.data[0]['link'],
                this.ecom = response.data.data[0]['ecom'],
                this.nama_produk = response.data.data[0]['nama_produk'],
                this.id_link = response.data.data[0]['id']
             ))
             .catch(error => alert(error));
    },
    setDataUpdate : function(){
        var arr_post = {
            link :  this.link,
            ecom :  this.ecom,
            nama_produk :  this.nama_produk,
            id : this.id_link
            }

        axios.post("set_update",arr_post,head_form)
                    .then(response => (
                        // alert('Berhasil ditambahkan')
                        alert("Berhasil ditambahkan")
                    ))
                    .catch(error => alert(error));
    }
  },
}
</script>