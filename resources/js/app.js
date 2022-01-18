
require('./bootstrap');

window.Vue = require('vue').default;

import router from './routes/routers'

Vue.component('navbar-component', require('./components/Navbar.vue').default);
Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('salesperson-component', require('./components/Salesperson/Salesperson.vue').default);
Vue.component('sales-component', require('./components/Sales/Sales.vue').default);

const app = new Vue({
    router,
    el: '#app',
});
