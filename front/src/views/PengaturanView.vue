<template>
    <Sidebar/>

    <div class="main-content" style="overflow-y:auto">
        <section class="section">
            <div class="section-header">
                <h1 class="w-100">
                    Pengaturan
                </h1>
            </div>

            <div class="section-body bg-white shadow-sm p-2">
                <div class="col-md-3 mx-auto">
                    <h5></h5>
                    <img v-bind:src="data_login.path_img" style="width:100%;" alt="">
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <span>Foto Profile</span>
                        <input type="file" class="form-control" id="file" ref="file" v-on:change="gantiFile()">
                    </div>
                    <div class="col-md-6">
                        <span>Username</span>
                        <input type="text" v-model="username" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <span>Password</span>
                        <input type="password" v-model="password" class="form-control">
                    </div>
                </div>
                <hr>
                <button v-on:click="simpan()" class="col-md-12 btn btn-primary">Simpan Perubahan</button>
            </div>
        </section>
    </div>
</template>

<script>
    import Sidebar from '@/components/Sidebar.vue'
    import axios from 'axios'

    const head_form = {headers: {'Content-Type': 'multipart/form-data'}}

    export default {
        name: 'pengaturan',
        data(){
            return {
            data_login : {
                nama : localStorage.getItem('data-login_nama'),
                file : localStorage.getItem('data-login_img'),
                id : localStorage.getItem('data-login_id'),
                path_img : "http://localhost/research/back/assets/user_files/"+localStorage.getItem('data-login_img')
            }
            }
        },
        created() {
            axios.defaults.baseURL = 'http://localhost/research/back/cuser/'
        },
        components: {
            Sidebar,
        },
        methods: {
            simpan : function () {
                var arr_post = {
                    foto : this.file,
                    username : this.username,
                    password : this.password,
                    id : this.data_login.id
                }
                
                axios.post("pengaturan",arr_post,head_form)
                    .then(function (response) {
                        // console.log(response)
                        alert('Berhasil diupdate')
                        location.reload()
                    })
                    .catch(error => alert(error));
            },
            gantiFile(){
                this.file = this.$refs.file.files[0];
            }
        },
    }
</script>
