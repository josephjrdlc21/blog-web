import { createApp } from 'vue';
import App from './components/App.vue';
import axios from 'axios';
import router from './router';
import { RouterLink, RouterView } from 'vue-router';

const app = createApp(App);

// app.config.globalProperties.$axios = axios;
app.use(router)
app.component('RouterLink', RouterLink);
app.component('RouterView', RouterView);

app.mount('#app');