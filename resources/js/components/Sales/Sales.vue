<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
          <router-link :to="{ name: 'addvendas' }" class="btn btn-success">Cadastrar</router-link>
      </div>
      <!-- <div class="col">
          <search @searchSalesperson="searchSalesperson"></search>
      </div> -->
    </div>
    <hr>
    <h1>Listagem das Vendas</h1>
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>ID venda</th>
          <th>ID vendedor</th>
          <th>Vendedor</th>
          <th>Email</th>
          <th>% Comissão</th>
          <th>Valor comissão</th>
          <th>Valor venda</th>
          <th>Data venda</th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="(sales, index) in data" :key="index">
          <td>{{ sales.id }}</td>
          <td>{{ sales.salespeople.id }}</td>
          <td>{{ sales.salespeople.name }}</td>
          <td>{{ sales.salespeople.email }}</td>          
          <td>{{ sales.salespeople.commission }}</td>  
          <td>{{ sales.commission_value }}</td> 
          <td>{{ sales.value }}</td> 
          <td>{{ sales.created_at.substr(0,10).split('-').reverse().join('/') }}</td> 
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      data: {},
    };
  },
  methods:{
      getDatas(){
          const url = "http://localhost:8000/api/sale"
          axios(url).then((res)=>{
              console.log(res.data);
              this.data = res.data
          })
      }
  },
  mounted(){
      this.getDatas();
  }
}

</script>

<style scoped>
</style>