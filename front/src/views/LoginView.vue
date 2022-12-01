<template>
    <div class="rounded bg-white col-md-5 mx-auto mt-5" id="container">
				<div class="row">
					<div class="col-md-12 p-4">
						<h1 class="text-navy text-center">
							Inspect
							<hr class="bg-navy">
						</h1>

						<label class="text-navy" for="">Username</label>
						<input v-model="username" type="text" class="form-control">

						<label class="text-navy" for="">Password</label>
						<input v-model="password" type="password" class="form-control">

						<br>
						<!-- <button class="btn bg-warning col-md-12">Login</button> -->
                        <!-- <router-link class="btn bg-warning col-md-12" to="/link">Login</router-link> -->
                        <button class="btn bg-warning col-md-12" v-on:click="login()">Login</button>
					</div>
				</div>
			</div>

    <div>
        <!-- <b-form-input v-model="text" placeholder="Enter your name"></b-form-input>
        <div class="mt-2">Value: {{ text }}</div> -->
    </div>
</template>

<script>
import axios from 'axios'

const head_form = {headers: {'Content-Type': 'multipart/form-data'}}

export default {
    name : 'ViewLogin',
    created() {
        axios.defaults.baseURL = 'http://localhost/research/back/'
    },
    methods: {
        
        login: function(){
            let self = this;
            const arr_post = {
                'username' : this.username,
                'password' : this.password
            }
            axios.post("clogin/aksi_login",arr_post,head_form,head_form)
                .then(function (resp) {
                    var dlog = resp.data;
                    if(dlog['status'] == 'ok'){
                        localStorage.setItem('data-login_nama',dlog['data']['nama'])
                        localStorage.setItem('data-login_img',dlog['data']['img'])
                        localStorage.setItem('data-login_id',dlog['data']['id'])
                        self.$router.push({name:'report'})
                    }else{
                        alert('username atau password salah');
                    }
                })
                .catch(error => alert(error))
        }
    },
}
</script>

<style scoped>
    .bg-light-dark{
        background-color:#f7f7f7 !important;
    }

    .text-navy{
        color : #1c233d;
    }

    .bg-navy{
        background-color : #1c233d;
    }

    .btn-navy{
        background-color : #1c233d;
        color:white;
    }

    #img-banner{
        width: 100%;
        height:auto;
    }

    #container{
        box-shadow: 0px 10px 41px -10px rgba(0,0,0,0.75);
        -webkit-box-shadow: 0px 10px 41px -10px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 10px 41px -10px rgba(0,0,0,0.75);
        /* background-image: url(https://img.freepik.com/free-vector/abstact-hexagon-background-memphis-style_1017-31955.jpg?w=826&t=st=1659758097~exp=1659758697~hmac=1c4a6e79a358765e517d0c70dc5b021ed5552462c9c0ee81523acc832a073ee8); */
        /* background-size:cover; */
    }

    body{
        background-image : url(https://sys.fastprint.co.id/inspect/assets/img/custom/banner-login.jpg) !important;
        background-size:cover !important;
    }
</style>