<template>
    <Sidebar/>
    <div class="main-content" style="overflow-y:auto">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Link</h1>
            </div>
            <div class="section-body">
                <div class="bg-white mx-auto rounded shadow-sm col-md-12 p-4">
                    <form ref="formTambah">
                        <span>Nama Produk</span>
                        <input v-model="nama_produk" id="nama_produk" type="text" class="col-md-12 form-control">

                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <span>Link Produk</span>
                                <input type="text" v-model="link_produk" class="col-md-12 form-control" id="link_produk">
                            </div>
                            <div class="col-md-2">
                                <span>Jenis Ecom</span>
                                <select class="form-control" v-model="jenis_ecom" name="" id="">
                                    <option value="">PIlih Ecom</option>
                                    <option value="shopee">Shopee</option>
                                    <option value="tokopedia">Tokopedia</option>
                                </select>
                            </div>
                        </div>
                        
                        <br>
                    </form>
                    
                    <div class="d-flex justify-content-between mt-2 p-2">
                        <router-link class="btn-warning btn col-md-5" to="/link">Kembali</router-link>
                        <button class="btn-primary btn col-md-5" id="btn-simpan" v-on:click="simpan_link()"><span style="font-size:16px">Simpan</span></button>
                    </div>
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
            Sidebar,
        },
        created() {
            axios.defaults.baseURL = 'http://localhost/research/back/clink'
        },
        methods: {
            simpan_link : function (){
                var arr_post = {
                    nama_produk : this.nama_produk,
                    link_produk : this.link_produk,
                    jenis_ecom : this.jenis_ecom
                }

                axios.post("tambah",arr_post,head_form)
                    .then(response => (
                        // alert('Berhasil ditambahkan')
                        alert("Berhasil ditambahkan"),
                        this.$refs.formTambah.reset()
                    ))
                    .catch(error => alert(error));
            },
        },
    }
</script>