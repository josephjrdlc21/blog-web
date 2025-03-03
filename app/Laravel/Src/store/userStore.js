import { defineStore } from "pinia";
import axios from "axios";

export const useUserStore = defineStore("user", {
    state: () => ({
        users: [],
        user: {},
        errors: {},
        msg: '',
    }),

    getters : {

    },

    actions: {
        async usersIndex() {
            try {
                const response = await axios.get(`${API_BASE_URL}/users`);

                this.users = response.data.data;
            } catch(error) {
                this.error = error.message;

                console.log(error);
            }
        },

        async usersShow(id) {
            try {
                const response = await axios.get(`${API_BASE_URL}/users/show/${id}`);

                this.user = response.data.data;
            } catch(error) {
                this.error = error.response.data;

                console.log(error);
            }
        },

        async usersCreate(userData) {
            try {
                const response = await axios.post(`${API_BASE_URL}/users/store`, userData);

                this.user = response.data.data;
            } catch(error) {
                this.errors = error.response.data;

                console.log(this.errors);
            }
        },
    },
});