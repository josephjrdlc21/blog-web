import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem('token') || null,
        user: JSON.parse(localStorage.getItem('user')) || null,
    }),

    getters: {

    },
    
    actions: {
        async login(data) {
            try {
                const response = await axios.post(`${API_BASE_URL}/login`, data);

                this.token = response.data.token;
                this.user = response.data.data.name;

                localStorage.setItem('token', this.token);
                localStorage.setItem('user', JSON.stringify(this.user));

                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

                return true;
            } catch(error) {
                console.log("Error " + error);

                return false;
            }
        },

        async logout() {
            try {
                if(this.token){
                    await axios.post(`${API_BASE_URL}/logout`, {}, {
                        headers: { Authorization: `Bearer ${this.token}`,},
                    });
                }
            } catch (error) {
                console.log("Error " + error);
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
