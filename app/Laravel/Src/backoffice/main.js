import { createApp } from 'vue';
import { createPinia } from 'pinia';
import Persistedstate from 'pinia-plugin-persistedstate';

import App from './App.vue';
import router from './router';

const pinia = createPinia();
const app = createApp(App);

pinia.use(Persistedstate);

app.use(pinia);
app.use(router);
app.mount('#app');