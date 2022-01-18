<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
          <router-link :to="{ name: 'addvendedor' }" class="btn btn-success">Cadastrar</router-link>
      </div>
      <!-- <div class="col">
          <search @searchSalesperson="searchSalesperson"></search>
      </div> -->
    </div>
    <hr>
    <h1>Listagem dos Vendedores</h1>
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>ID vendedor</th>
          <th>Nome</th>
          <th>Email</th>
          <th>% Comissão</th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="(salesperson, index) in data" :key="index">
          <td>{{ salesperson.id }}</td>
          <td>{{ salesperson.name }}</td>
          <td>{{ salesperson.email }}</td>          
          <td>{{ salesperson.commission }}</td>  
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
          const url = "http://localhost:8000/api/salesperson"
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