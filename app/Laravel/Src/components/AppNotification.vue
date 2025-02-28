<template>
    <div v-show="data.message" :class="`bs-toast toast toast-placement-ex m-2 fade bg-${data.type} top-0 end-0 show`" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">{{ data.type.toUpperCase() }} !</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" @click="clearQuery"></button>
        </div>
        <div class="toast-body">{{ data.message }}</div>
    </div>
</template>

<script setup>
    import { useRoute, useRouter } from 'vue-router';
    import { ref } from 'vue';

    const router = useRouter();
    const route = useRoute();

    const data = ref({
        message: route.query.message || '',
        type: route.query.type || 'info'
    });

    const clearQuery = () => {
        router.replace({ query: {} });
        data.value.message = '';
        data.value.type = '';
    };
</script>
