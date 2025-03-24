import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';

const pinia = createPinia();
const app = createApp(App);

window.API_BASE_URL = import.meta.env.VITE_API_BASE_URL_BACKOFFICE;
API_BASE_URL = window.API_BASE_URL;

app.use(pinia);
app.use(router);
app.mount('#app');