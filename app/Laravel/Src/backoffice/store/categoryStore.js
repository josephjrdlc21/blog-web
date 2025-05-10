import { defineStore } from "pinia";
import { useErrorStore } from "./errorStore";
import { categoryService } from "../services/backoffice/categoryService";

export const useCategoryStore = defineStore("category", {
    state: () => ({
        categories: {},
        category: {},
        isLoading: false,
    }),

    getters : {
        paginationRange(state) {
            const from = state.categories.from ?? 0;
            const to = state.categories.to ?? 0;
            const total = state.categories.total ?? 0;
        
            return `Showing ${from} to ${to} of ${total} entries`;
        }
    },

    actions: {
        async categoriesIndex(page, filter) {
            const errorStore = useErrorStore();
            this.isLoading = true;
            
            try {
                const response = await categoryService.index(page, filter);

                this.categories = response.data.data;
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async categoriesCreate(data, router){
            const errorStore = useErrorStore();
            this.isLoading = true;

            try{
                const response = await categoryService.create(data);

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'CategoriesIndex' });
            } catch(error){
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async categoriesEdit(id, router) {
            const errorStore = useErrorStore();

            try {
                const response = await categoryService.edit(id);

                this.category = response.data.data;
            } catch (error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'CategoriesIndex' });

                console.log("Error " + error);
            }  
        },

        async categoriesUpdate(id, data, router) {
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await categoryService.update(id, data);

                errorStore.setNotification("success", response.data, true);
                router.replace({ name: 'CategoriesIndex' });
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },

        async categoriesDelete(id, router){
            const errorStore = useErrorStore();
            this.isLoading = true;

            try {
                const response = await categoryService.destroy(id);
                
                errorStore.setNotification("success", response.data, true);
            } catch(error) {
                errorStore.setNotification("failed", error.response.data, true);
                router.replace({ name: 'CategoriesIndex' });

                console.log("Error " + error);
            } finally {
                this.isLoading = false;
            }
        },
    }
});