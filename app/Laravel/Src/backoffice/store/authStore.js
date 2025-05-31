import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import { authService } from "../services/backoffice/authService";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: null,
        user: null,
        userId: null,
        avatar: null,
        isLoading: false,
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    
    actions: {
        async login(data) {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await authService.login(data);

                this.token = response.data.token;
                this.user = response.data.data.name;
                this.userId = response.data.data.id;
                this.avatar = response.data.data.avatar?.full_path;

                errorStore.setNotification("success", response.data, true);
                return true;
            } catch (error) {
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

            try {
                const response = await authService.register(data);

                this.token = response.data.token;
                this.user = response.data.data.name;
                this.userId = response.data.data.id;

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'Index' });
            } catch (error) {
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
                if (this.token) {
                    const response = await authService.logout(this.token);
                    errorStore.setNotification("success", response.data, true);
                }
            } catch (error) {
                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }

            this.token = null;
            this.user = null;
            this.userId = null;
            this.avatar = null;

            return true;
        },
    },

    persist: {
        paths: ['token', 'user', 'userId', 'avatar'],
    },
});