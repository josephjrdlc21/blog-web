import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

const app = createApp(App);

window.API_BASE_URL = import.meta.env.VITE_API_BASE_URL;
API_BASE_URL = window.API_BASE_URL;

app.use(router)
app.mount('#app');