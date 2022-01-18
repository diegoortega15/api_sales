import Vue from 'vue'
import VueRouter from 'vue-router'

import Salesperson from '../components/Salesperson/Salesperson.vue'
import AddSalesperson from '../components/Salesperson/AddSalesperson.vue'
import Sales from '../components/Sales/Sales.vue'
import AddSales from '../components/Sales/AddSales.vue'
import Home from '../components/Home.vue'

Vue.use(VueRouter)

const routes = [
    { path: '/vendedor', component: Salesperson, name: 'vendedor'},
    { path: '/addvendedor', component: AddSalesperson, name: 'addvendedor'},
    { path: '/vendas', component: Sales, name: 'vendas'},
    { path: '/addvendas', component: AddSales, name: 'addvendas'},
    { path: '/', component: Home, name: 'home'},
]

const router = new VueRouter ({
    routes
})

export default router