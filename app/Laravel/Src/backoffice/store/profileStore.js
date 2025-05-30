import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import { useAuthStore } from "./authStore";
import { profileService } from "../services/backoffice/profileService";

export const useProfileStore = defineStore("profile", {
    state: () => ({
        profile: {},
        isLoading: false,
    }),

    getters : {
       
    },

    actions: {
        async profileIndex() {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await profileService.index();

                this.profile = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async profileUpdate(data, router) {
            const errorStore = useErrorStore();
            const authStore = useAuthStore();
            this.isLoading = true;

            try {
                const response = await profileService.update(data);

                authStore.user = response.data.data.name;

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'Index' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },
    },
});