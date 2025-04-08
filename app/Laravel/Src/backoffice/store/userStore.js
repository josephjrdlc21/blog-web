import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import axios from "axios";

export const useUserStore = defineStore("user", {
    state: () => ({
        users: {
            data: [],
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
        },
        user: {},
        isUsersLoaded: false,
    }),

    getters : {
        paginationRange(state) {
            const start = (state.users.current_page - 1) * state.users.per_page + 1;
            const end = start + state.users.data.length - 1;
            const total = state.users.total;
      
            return `Showing ${start} to ${end} of ${total} entries`;
        }
    },

    actions: {
        async usersIndex(page) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.get(`${API_BASE_URL}/backoffice/users?page=${page}`);

                this.users = response.data.data;
                this.isUsersLoaded = true;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            }
        },

        async usersCreate(data, router) {
            const errorStore = useErrorStore();

            try {
                const response = await axios.post(`${API_BASE_URL}/backoffice/users/store`, data);

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
                const response = await axios.get(`${API_BASE_URL}/backoffice/users/edit/${id}`);

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
                const response = await axios.post(`${API_BASE_URL}/backoffice/users/update/${id}`, data);

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
                const response = await axios.delete(`${API_BASE_URL}/backoffice/users/delete/${id}`);
                
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
                const response = await axios.get(`${API_BASE_URL}/backoffice/users/show/${id}`);

                this.user = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'UsersIndex' });

                console.log("Error " + error);
            }
        },
    },
});