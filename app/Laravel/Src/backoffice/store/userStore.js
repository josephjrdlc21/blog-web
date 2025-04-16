import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import { userService } from "../services/backoffice/userService";

export const useUserStore = defineStore("user", {
    state: () => ({
        users: {},
        user: {},
        isLoading: false,
    }),

    getters : {
        paginationRange(state) {
            const from = state.users.from ?? 0;
            const to = state.users.to ?? 0;
            const total = state.users.total ?? 0;
        
            return `Showing ${from} to ${to} of ${total} entries`;
        }
    },

    actions: {
        async usersIndex(page, filter) {
            const errorStore = useErrorStore();
            this.isLoading = true;
            
            try {
                const response = await userService.index(page, filter);

                this.users = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async usersCreate(data, router) {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await userService.create(data);

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'UsersIndex' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async usersEdit(id, router) {
            const errorStore = useErrorStore();

            try {
                const response = await userService.edit(id);

                this.user = response.data.data;
            } catch (error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'UsersIndex' });

                console.log("Error " + error);
            }
        },

        async usersUpdate(id, data, router) {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await userService.update(id, data);

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'UsersIndex' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async usersDelete(id, router){
            const errorStore = useErrorStore();

            try {
                const response = await userService.destroy(id);
                
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
            this.isLoading = true;

            try {
                const response = await userService.show(id);

                this.user = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'UsersIndex' });

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },
    },
});