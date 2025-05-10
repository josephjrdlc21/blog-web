<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Categories /</span> Create Category</h4>
            <div class="row">
                <div class="col-lg-6 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Create Category</h5>
                            <form @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_category" class="form-label">Category</label>
                                        <input type="text" v-model="data.category" class="form-control" id="input_category" placeholder="category">
                                        <small v-if="errorStore.validations.errors?.category" class="text-danger">
                                            {{ errorStore.validations.errors.category[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'CategoriesIndex' }" class="btn btn-outline-secondary" @click="errorStore.validations = {}">Cancel</RouterLink>
                                    <button type="submit" class="btn btn-primary">{{ categoryStore.isLoading ? 'Loading..' : 'Submit' }}</button>                           
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
    import MainLayout from '../../layouts/MainLayout.vue';
    import Notification from '../../components/AppNotification.vue';
    
    import { useCategoryStore } from '../../store/categoryStore';
    import { useErrorStore } from '../../store/errorStore';
    import { RouterLink, useRouter } from 'vue-router';
    import { onMounted, onUnmounted, ref } from 'vue';

    const categoryStore = useCategoryStore();
    const errorStore = useErrorStore();
    const router = useRouter();

    const data = ref({category: ''});

    onMounted(() => {
        categoryStore.category = {};
    });
    onUnmounted(() => {
        categoryStore.category = {};
    });

    const handleSubmit = async () => {
        await categoryStore.categoriesCreate(data.value, router);
    }
</script>