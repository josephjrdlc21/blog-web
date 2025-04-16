import api from "./apiService";

export const userService = {
    index(page, filter) {
        return api.get(`/backoffice/users`, {
            params: {
                keyword: filter.keyword,
                type: filter.type,
                status: filter.status,
                start_date: filter.from,
                end_date: filter.to,
                page
            }
        });
    },

    create(data) {
        return api.post(`/backoffice/users/store`, data);
    },

    edit(id) {
        return api.get(`/backoffice/users/edit/${id}`);
    },

    update(id, data) {
        return api.post(`/backoffice/users/update/${id}`, data);
    },

    destroy(id) {
        return api.delete(`/backoffice/users/delete/${id}`);
    },

    show(id) {
        return api.get(`/backoffice/users/show/${id}`);
    }
};