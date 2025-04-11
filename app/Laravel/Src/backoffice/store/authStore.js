import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem('token') || null,
        user: JSON.parse(localStorage.getItem('user')) || null,
        isLoading: false,
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    
    actions: {
        hydrate() {
            if (this.token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            }
        },
        
        async login(data) {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await axios.post(`${API_BASE_URL}/backoffice/login`, data);

                this.token = response.data.token;
                this.user = response.data.data.name;

                localStorage.setItem('token', this.token);
                localStorage.setItem('user', JSON.stringify(this.user));

                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

                errorStore.setNotification("success", response.data, true);

                return true;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);
                console.log("Error " + error);

                return false;
            } finally {
                this.isLoading = false;
            }
        },

        async register(data, router) {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try{
                const response = await axios.post(`${API_BASE_URL}/backoffice/register`, data);

                this.token = response.data.token;
                this.user = response.data.data.name;

                localStorage.setItem('token', this.token);
                localStorage.setItem('user', JSON.stringify(this.user));

                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'Index' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async logout() {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                if(this.token){
                    const response = await axios.post(`${API_BASE_URL}/backoffice/logout`, {}, {
                        headers: { Authorization: `Bearer ${this.token}`,},
                    });

                    errorStore.setNotification("success", response.data, true);
                }
            } catch (error) {
                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
      
            this.token = null;
            this.user = null;

            localStorage.removeItem('token');
            localStorage.removeItem('user');

            delete axios.defaults.headers.common['Authorization'];

            return true;
        },
    },
});
