import { defineStore } from "pinia";

export const useErrorStore = defineStore("error", {
    state: () => ({
        notificationStatus: '',
        notificationMsg: {},
        validations: {},
        isPopUp: false,
    }),

    getters: {
        badgeClass: (state) => {
            switch (state.notificationStatus) {
                case 'danger':
                case 'failed':
                case 'error':
                    return 'danger';
                case 'info':
                    return 'info';
                case 'warning':
                    return 'warning';
                case 'success':
                    return 'success';
                default:
                    return 'secondary';
            }
        },
    },

    actions: {
        setNotification(status, message, isPop) {
            this.notificationStatus = status;
            this.notificationMsg = message;
            this.validations = message;
            this.isPopUp = isPop;
        },

        clearNotification() {
            this.notificationStatus = '';
            this.notificationMsg = '';
            this.validations = '';
            this.isPopUp = false;
        },
    },

    persist: {
        paths: ['notificationStatus', 'notificationMsg', 'validations', 'isPopUp'],
    },
});