<template>
    <div v-show="data.message" :class="`alert alert-${data.type} alert-dismissible`" role="alert">
        {{ data.message }}
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="clearQuery"></button>
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
