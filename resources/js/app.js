import { createApp } from 'vue';
import axios from 'axios'; // Import axios
import CustomerForm from './components/CustomerForm.vue';

const app = createApp({});
app.component('customer-form', CustomerForm);
app.mount('#app');

// CSRF
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
