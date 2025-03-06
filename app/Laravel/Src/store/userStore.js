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
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            }
        },

        async usersCreate(data, router) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.post(`${API_BASE_URL}/users/store`, data);

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'UsersIndex' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            }
        },

        async usersEdit(id, router) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.get(`${API_BASE_URL}/users/edit/${id}`);

                this.user = response.data.data;
            } catch (error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'UsersIndex' });

                console.log("Error " + error);
            }
        },

        async usersUpdate(id, data, router) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.post(`${API_BASE_URL}/users/update/${id}`, data);

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'UsersIndex' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            }
        },

        async usersDelete(id, router){
            const errorStore = useErrorStore();

            try {
                const response = await axios.delete(`${API_BASE_URL}/users/delete/${id}`);
                
                errorStore.setNotification("success", response.data, true);
                
                await this.usersIndex(); 

                router.replace({ name: 'UsersIndex' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'UsersIndex' });

                console.log("Error " + error);
            }
        },

        async usersShow(id, router) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.get(`${API_BASE_URL}/users/show/${id}`);

                this.user = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'UsersIndex' });

                console.log("Error " + error);
            }
        },
    },
});