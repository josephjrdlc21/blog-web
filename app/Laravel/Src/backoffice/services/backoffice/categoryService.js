import api from "./apiService";

export const categoryService = {
    index(page, filter) {
        return api.get(`/backoffice/categories`, {
            params: {
                keyword: filter.keyword,
                start_date: filter.from,
                end_date: filter.to,
                page
            }
        });
    },

    create(data) {
        return api.post(`/backoffice/categories/store`, data); 
    },

    edit(id) {
        return api.get(`/backoffice/categories/edit/${id}`);
    },

    update(id, data) {
        return api.post(`/backoffice/categories/update/${id}`, data);
    },

    destroy(id) {
        return api.delete(`/backoffice/categories/delete/${id}`);
    }
}