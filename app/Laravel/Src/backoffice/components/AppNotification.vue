<template>
    <div v-show="errorStore.notificationStatus" :class="`bs-toast toast toast-placement-ex m-2 fade bg-${errorStore.badgeClass} top-0 end-0 show`" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">{{ errorStore.notificationMsg.msg }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" @click="handleCloseNotif"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</template>

<script setup>
    import { onUnmounted } from 'vue';
    import { useErrorStore } from '../store/errorStore';

    const errorStore = useErrorStore();

    if(errorStore.isPopUp){
        setTimeout(() => {
            errorStore.clearNotification();
        }, 2000)
    }

    const handleCloseNotif = () => {
        errorStore.clearNotification();
    };
</script>
