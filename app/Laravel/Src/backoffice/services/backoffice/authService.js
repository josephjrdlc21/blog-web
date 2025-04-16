import api from "./apiService";

export const authService = {
    login(data) {
        return api.post(`/backoffice/login`, data);
    },

    register(data) {
        return api.post(`/backoffice/register`, data);
    },

    logout(token) {
        return api.post(`/backoffice/logout`, {}, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
    }
};