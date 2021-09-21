require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

//import Vue from 'vue';
import App from './views/App';

// import del router
import router from './router';

const app = new Vue({
  el: '#app',
  render: h => h(App),
  router
});




