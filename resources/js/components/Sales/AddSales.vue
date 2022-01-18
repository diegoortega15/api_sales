<template>
  <div class="container">
    <h1>Cadastrar nova venda</h1>
    <form class="form" @submit.prevent="onSubmit">
      <div class="alert alert-danger mb-2 mt-2" role="alert" v-if="alert.message">{{ alert.message}}</div>
      <div class="alert alert-success mb-2 mt-2" role="alert" v-if="success.message">{{ success.message}}</div>
      <div class="form-group">
        <input
          type="text"
          v-model="data.salespeople_id"
          class="form-control"
          placeholder="ID vendedor"
        />
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
        salespeople_id: "",
        value: "",
      },
      alert:{message:""},
      success:{message:""}
    };
  },
  methods: {
    onSubmit() {
      if(this.validation()){
        const url = "http://localhost:8000/api/sale"
        axios
          .post(url,this.data)
          .then((res)=>{
            console.log(res)
            this.success.message="Venda registrada com sucesso, ID: "+res.data.sale_id
          })
          .catch((error)=>{
            console.log("erro")
            console.log(error.response)
            this.alert.message = error.response.data.error
          })
      }
    },
    validation(){
      if(!this.data.salespeople_id){
        this.alert.message = "Favor preencher o ID do vendedor"
        return false
      }
      if(!this.data.value){
        this.alert.message = "Favor preencher o valor da venda"
        return false
      }
       this.alert.message=""
       return true
    }
  },
};
</script>

<style scoped>

</style>