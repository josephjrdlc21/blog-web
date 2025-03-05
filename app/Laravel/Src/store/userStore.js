import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import axios from "axios";

export const useUserStore = defineStore("user", {
    state: () => ({
        users: [],
        user: {},
    }),

    getters : {

    },

    actions: {
        async usersIndex() {
            const errorStore = useErrorStore();

            try {
                const response = await axios.get(`${API_BASE_URL}/users`);

                this.users = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data);

                console.log(error);
            }
        },

        async usersCreate(data) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.post(`${API_BASE_URL}/users/store`, data);

                this.user = response.data.data;
                errorStore.setNotification("success", response.data);
            } catch(error) {
                errorStore.setNotification("failed", error.response.data);

                console.log(error);
            }
        },

        async usersEdit(id) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.get(`${API_BASE_URL}/users/edit/${id}`);

                this.user = response.data.data;
            } catch (error) {
                errorStore.setNotification("failed", error.response.data);

                console.log(error);
            }
        },

        async usersUpdate(id, data) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.post(`${API_BASE_URL}/users/update/${id}`, data);

                this.user = response.data.data;
                errorStore.setNotification("success", response.data);
            } catch(error) {
                errorStore.setNotification("failed", error.response.data);

                console.log(error);
            }
        },

        async usersShow(id) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.get(`${API_BASE_URL}/users/show/${id}`);

                this.user = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data);

                console.log(error);
            }
        },
    },
});