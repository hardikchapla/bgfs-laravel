require('./bootstrap'); 
import Vue from 'vue';  
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'; 

Vue.config.devtools = false;
// Vue.config.globalProperties.axios = axios;

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
    toast: true,
    timer: 7000,
    timerProgressBar: true,
    showConfirmButton: false,
    position: 'top-end',
};      

Vue.use(VueAxios, axios)
Vue.use(VueSweetalert2, options);  
 
//User
Vue.component('login_page', require('./Components/auth/login').default); 
Vue.component('register_page', require('./Components/auth/register').default); 
Vue.component('forget_password_page', require('./Components/auth/forget_password').default); 
Vue.component('verification_page', require('./Components/auth/verification').default); 

const app2 = new Vue({  
    el: '#app',  
    mounted() {    
    }
});
 