<template>
  <div class="container mt-5">
    <hr>
    <div class="row">
      <div class="col-5">
        <h1>Listagem dos Vendedores</h1>
      </div>
      <div class="col-5">
        <div class="input-group">
          <select class="custom-select" id="inputGroupSelect04" @change="changeSelect">
            <option value="0" selected>Todos</option>
            <option 
              v-for="salesperson in dataSalespeople"
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
          <router-link :to="{ name: 'addvendedor' }" class="btn btn-success">Novo vendedor</router-link>
      </div>
    </div>
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
      dataSalespeople:{},
      selectedSalespeopleID:0
    };
  },
  methods:{
      getDatas(){
          const url = "http://localhost:8000/api/salesperson"
          axios(url).then((res)=>{
              this.data = res.data
              this.dataSalespeople = res.data
          })
      },
      changeSelect(variable){
        this.selectedSalespeopleID = variable.target.value
      },
      
      search(){
        if(this.selectedSalespeopleID > 0){
          this.data = this.dataSalespeople.filter((salespeople) => {
                        return salespeople.id == this.selectedSalespeopleID
                  })
        }else{
          this.data = this.dataSalespeople
        }
      },
  },
  mounted(){
      this.getDatas();
  }
}

</script>

<style scoped>
</style>