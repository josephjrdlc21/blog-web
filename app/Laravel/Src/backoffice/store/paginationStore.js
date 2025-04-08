import { defineStore } from "pinia";

export const usePaginationStore = defineStore("pagination", {
    state: () => ({
        currentPage: 1,
        totalPages: 1,
        perPage: 10,
    }),

    getters: {
        getCurrentPage: (state) => state.currentPage,
        getTotalPages: (state) => state.totalPages,
        getPerPage: (state) => state.perPage,
    },

    actions: {
        
    },
});