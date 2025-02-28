<template>
    <span :class="`badge ${badgeClass}`">{{ badgeText }}</span>
</template>

<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        status: String
    });

    const badgeClass = computed(() => {
        switch (props.status) {
            case 'inactive':
                return 'bg-label-secondary';
            case 'active':
                return 'bg-label-success';
            default:
                return 'bg-label-primary';
        }
    });

    const badgeText = computed(() => {
        switch (props.status) {
            case 'inactive':
                return 'Inactive';
            case 'active':
                return 'Active';
            default:
                return 'Unknown';
        }
    });
</script>
