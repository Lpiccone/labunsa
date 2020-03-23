
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue' 

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('vistaanalysis', require('./components/Analysis.vue'));
Vue.component('analysis2', require('./components/Analysis2.vue'));
Vue.component('analysis3', require('./components/Analysis3.vue'));
Vue.component('category', require('./components/Category.vue'));
Vue.component('detail', require('./components/Detail.vue'));
Vue.component('headboards', require('./components/Headboards.vue'));
Vue.component('headboards2', require('./components/Headboards2.vue'));
Vue.component('parameter', require('./components/Parameter.vue'));
Vue.component('patient', require('./components/Patient.vue'));
Vue.component('referencia', require('./components/Referencia.vue'));
Vue.component('result', require('./components/Result.vue'));
Vue.component('resultado', require('./components/Resultado.vue'));
Vue.component('nuevo', require('./components/nuevo.vue'));
Vue.component('nuevo2', require('./components/nuevo.vue'));
Vue.component('in', require('./components/In.vue'));
Vue.component('out', require('./components/Out.vue'));
Vue.component('reactives', require('./components/Reactives.vue'));


const app = new Vue({
    el: '#app',
  data: {
    menu: 0,
    //url: '//10.20.10.4:8000',
    //url: '//10.20.10.4:8001',
    //url: '//10.20.10.4:8005',
    url: '//desarrollo.unsa.edu.pe/labunsa/public',
    //url: '//127.0.0.1:8000',
    //url: '10.20.10.4/labunsa'
  }
});
