<template>
    <Sidebar/>

    <div class="main-content" style="overflow-y:auto">
        <section class="section">
            <div class="section-header">
                <h1 class="w-100">
                    Report
                </h1>
            </div>

            <div class="section-body bg-white shadow-sm p-2">
                <GrafikReport/>
                <hr>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">No</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Nama</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Ecom</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Link</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Terjual</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Stok</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Harga</th>
                            <th class="bg-primary text-center text-white sticky-first-tr" rowspan="2">Omset</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(l, index) in dataTable">
                            <td>{{ index+1 }}</td>
                            <td>{{ l.nama_produk }}</td>
                            <td>{{ l.ecom }}</td>
                            <td>{{ l.link }}</td>
                            <td>{{ l.terjual_now }}</td>
                            <td>{{ l.stok }}</td>
                            <td>{{ l.harga }}</td>
                            <td>{{ l.omset_now }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>

<script>
import Sidebar from '@/components/Sidebar.vue'
import GrafikReport from '@/components/GrafikReport.vue'
import axios from 'axios'

export default {
  name: 'HomeView',
  components: {
    Sidebar,
    GrafikReport
  },
  data() {
    return {
      dataTable : {}
    }
  },
  created() {
    axios.defaults.baseURL = 'http://localhost/research/back/creport/',
    this.getDataTable()
  },
  methods: {
    getDataTable : function(){
      axios.get('get_report_table')
            .then(response => (
              this.dataTable = response.data.data
             ))
             .catch(error => alert(error))
    }
  }
}
</script>
