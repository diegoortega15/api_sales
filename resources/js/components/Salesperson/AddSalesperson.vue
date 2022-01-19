<template>
  <div class="container">
    <hr>
    <h1>Cadastrar novo vendedor</h1>
    <form class="form" @submit.prevent="onSubmit">
      <div class="alert alert-danger mb-2 mt-2" role="alert" v-if="alert.message">{{ alert.message}}</div>
      <div class="alert alert-success mb-2 mt-2" role="alert" v-if="success.message">{{ success.message}}</div>
      <div class="form-group">
        <input
          type="text"
          v-model="data.name"
          class="form-control"
          placeholder="Nome Vendedor"
        />
      </div>
      <div class="form-group">
        <input
          type="email"
          v-model="data.email"
          class="form-control"
          placeholder="Email"
        />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <router-link :to="{ name: 'vendedor' }" class="btn btn-danger">Cancelar</router-link>
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
        name: "",
        email: "",
      },
      alert:{message:""},
      success:{message:""}
    };
  },
  methods: {
    onSubmit() {
      if(this.validation()){
        const url = "http://localhost:8000/api/salesperson"
        axios
          .post(url,this.data)
          .then((res)=>{
            this.success.message="Vendedor registrado com sucesso, ID: "+res.data[0].id
          })
          .catch((error)=>{
            this.alert.message = error.response.data.errors
          })
      }
    },
    validation(){
      if(!this.data.name){
        this.alert.message = "Favor preencher o nome do vendedor"
        return false
      }
      if(!this.data.email){
        this.alert.message = "Favor preencher o email do vendedor"
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