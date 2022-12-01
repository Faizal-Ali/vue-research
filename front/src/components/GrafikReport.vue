<template>
  <!-- <LineChart :chartData="dataGrafik" /> -->
  <LineChart :chartData="data" />
  <!-- {{data}} -->
</template>

<script>
import { defineComponent } from 'vue';
import { LineChart } from 'vue-chart-3';
import { Chart, registerables } from "chart.js";
import axios from 'axios'

Chart.register(...registerables);
export default defineComponent({
  name: 'Home',
  components: { LineChart },
  data() {
    return {
      data : {}
    }
  },
  created() {
    axios.defaults.baseURL = 'http://localhost/research/back/creport/',
    this.getDataGrafik()
  },
  methods: {
    getDataGrafik : function(){
      axios.get('get_report')
            .then(response => (
              this.data = response.data,
                console.log(response.data)
             ))
             .catch(error => alert(error))
    }
  }
});
</script>