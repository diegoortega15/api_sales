<template>
  <div class="container">
    <hr>
    <h1>Cadastrar nova venda</h1>
    <form class="form" @submit.prevent="onSubmit">
      <div class="alert alert-danger mb-2 mt-2" role="alert" v-if="alert.message">{{ alert.message}}</div>
      <div class="alert alert-success mb-2 mt-2" role="alert" v-if="success.message">{{ success.message}}</div>
      <div class="form-group">
        <select class="form-control" @change="changeSelect">
          <option value="">Selecione um vendedor</option>
          <option 
            v-for="salesperson in salespeople"
            :key="salesperson.id"
            :value="salesperson.id"
          >{{salesperson.name}}
          </option>
        </select>
      </div>
      <div class="form-group">
        <input
          type="number"
          step=".01"
          v-model="data.value"
          class="form-control"
          placeholder="Valor da venda"
        />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <router-link :to="{ name: 'vendas' }" class="btn btn-danger">Cancelar</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      data: {
        salespeople_id: 0,
        value: "",
      },
      alert:{message:""},
      success:{message:""},
      salespeople:{},
    };
  },
  methods: {
    onSubmit() {
      if(this.validation()){
        const url = "http://localhost:8000/api/sale"
        axios
          .post(url,this.data)
          .then((res)=>{
            this.success.message="Venda registrada com sucesso, ID: "+res.data.sale_id
          })
          .catch((error)=>{
            this.alert.message = error.response.data.error
          })
      }
    },
    validation(){
      if(this.data.salespeople_id == 0){
        this.alert.message = "Favor selecionar um vendedor"
        return false
      }
      if(!this.data.value){
        this.alert.message = "Favor preencher o valor da venda"
        return false
      }
       this.alert.message=""
       return true
    },
    getSalepeople(){
      const url = "http://localhost:8000/api/salesperson"
          axios(url).then((res)=>{
              this.salespeople = res.data
          })
    },
    changeSelect(variable){
      this.data.salespeople_id = variable.target.value
    }
  },
  mounted(){
      this.getSalepeople();
  }
};
</script>

<style scoped>

</style>