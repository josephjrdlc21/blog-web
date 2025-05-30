import api from "./apiService";

export const profileService = {
    index() {
        return api.get(`/backoffice/profile`);
    },

    update(data) {
        return api.post(`/backoffice/profile/edit`, data);
    }
};