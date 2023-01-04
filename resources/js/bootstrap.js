// for this project we don't need lodash so i am commenting it out
// window._ = require('lodash');

// I also don't need bootstrap for this because this is vue app and we will be using vue-bootstrap for consistency
// try {    require('bootstrap'); } catch (e) {}

// we need axios for making api call. it is not required for making api call but i like axios to i include this package.
// we can also use native fetch api for making api call
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = '/api/';

window.Vue = require('vue').default;
import App from './App.vue';
import VueAxios from 'vue-axios';
import VeeValidate from 'vee-validate';

// Using for the validation
// Renaming the field because it'll conflict with bootstrap-vue
Vue.use(VeeValidate, { fieldsBagName: 'veeFields' });
// Using for api call
Vue.use(VueAxios, axios);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',
    render: h => h(App)
});