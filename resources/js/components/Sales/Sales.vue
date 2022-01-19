<template>
  <div class="container mt-5">
    <hr>
    <div class="row">
      <div class="col-5">
        <h1>Listagem das Vendas</h1> 
      </div>
      <div class="col-5">
        <div class="input-group">
          <select class="custom-select" id="inputGroupSelect04" @change="changeSelect">
            <option value="0" selected>Todos</option>
            <option 
              v-for="salesperson in salespeople"
              :key="salesperson.id"
              :value="salesperson.id"
            >{{salesperson.name}}
            </option>
          </select>
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" @click="search">Buscar</button>
          </div>
        </div>
      </div>
      <div class="col-2">
          <router-link :to="{ name: 'addvendas' }" class="btn btn-success">Nova venda</router-link>
      </div>
    </div>
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
      dataSales:{},
      salespeople:{},
      selectedSalespeopleID:0
    };
  },
  methods:{
      getDatas(){
          const url = "http://localhost:8000/api/sale"
          axios(url).then((res)=>{
              this.data = res.data
              this.dataSales = res.data
          })
      },
      getSalepeople(){
      const url = "http://localhost:8000/api/salesperson"
          axios(url).then((res)=>{
              this.salespeople = res.data
          })
      },
      search(){
        if(this.selectedSalespeopleID > 0){
          this.data = this.dataSales.filter((sale) => {
                        return sale.salespeople_id == this.selectedSalespeopleID
                  })
        }else{
          this.data = this.dataSales
        }
      },
      changeSelect(variable){
        this.selectedSalespeopleID = variable.target.value
      },
  },
  mounted(){
      this.getDatas()
      this.getSalepeople()
  }
}

</script>

<style scoped>
</style>