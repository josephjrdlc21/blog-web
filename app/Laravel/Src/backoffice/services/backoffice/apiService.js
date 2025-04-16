import axios from 'axios';
import { useAuthStore } from '../../store/authStore';

const api = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    timeout: 10000,
});

api.interceptors.request.use(config => {
    const authStore = useAuthStore();

    if (authStore.token) {
        config.headers.Authorization = `Bearer ${authStore.token}`;
    }

    return config;
}, 
error => {
    return Promise.reject(error);
});

export default api;