<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Categories /</span> List</h4>
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <form @submit.prevent="getCategories">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Advanced Filters</h5>
                                <div class="row">
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_keyword" class="form-label">Keyword</label>
                                        <input type="text" v-model="filter.keyword" class="form-control" id="input_keyword" placeholder="e.g, Category">
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_from" class="form-label">From</label>
                                        <input class="form-control" v-model="filter.from" type="date" id="input_from">
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_to" class="form-label">To</label>
                                        <input class="form-control" v-model="filter.to" type="date" id="input_to">
                                    </div>
                                </div>
                                <div class="demo-inline-spacing">
                                    <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
                                    <button class="btn btn-sm btn-outline-primary" @click="resetFilter">Reset Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Record Data</h5>
                            <div style="margin-right: 24px;">
                                <RouterLink :to="{ name: 'CategoriesCreate' }" class="btn btn-primary">Create Category</RouterLink>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-if="categoryStore.isLoading">
                                        <td colspan="5" class="text-center">Loading...</td>
                                    </tr>
                                    <tr v-else-if="!categoryStore.isLoading && categoryStore.categories.data?.length" v-for="(category, index) in categoryStore.categories.data" :key="category.id">
                                        <td class="text-center">{{ (categoryStore.categories.per_page * (categoryStore.categories.current_page - 1)) + index + 1 }}</td>
                                        <td class="text-primary"><RouterLink :to="{ name: 'CategoriesEdit', params: {id: category.id} }">{{ category.name }}</RouterLink></td>
                                        <td>{{ category.created_at }}</td>
                                        <td>{{ category.updated_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" style="" data-bs-popper="static">
                                                    <li><RouterLink :to="{ name: 'CategoriesEdit', params: {id: category.id} }" class="dropdown-item"> Edit Details</RouterLink></li>
                                                    <li><button @click="handleDelete(category.id)" class="dropdown-item"> Delete Category</button></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="5" class="text-center">No records found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding-left: 20px; padding-right: 20px;">
                            <p v-if="!categoryStore.isLoading" class="mt-4">{{ categoryStore.paginationRange }}</p>
                            <Bootstrap5Pagination :data="categoryStore.categories" @pagination-change-page="getCategories" size="small"/>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
    import MainLayout  from '../../layouts/MainLayout.vue';
    import Notification from '../../components/AppNotification.vue';

    import { useCategoryStore } from '../../store/categoryStore';
    import { useErrorStore } from '../../store/errorStore';
    import { onMounted, onUnmounted, ref } from 'vue';
    import { RouterLink, useRouter } from 'vue-router';
    import { Bootstrap5Pagination } from 'laravel-vue-pagination';

    const categoryStore = useCategoryStore();
    const errorStore = useErrorStore();
    const router = useRouter();
    
    const filter = ref({keyword: '', from: '', to: '',});

    const getCategories = async (page = 1) => {
        await categoryStore.categoriesIndex(page, filter.value);

        filter.value.keyword = categoryStore.categories.keyword || '';
        filter.value.from = categoryStore.categories.start_date || '';
        filter.value.to = categoryStore.categories.end_date || '';
    }

    onMounted(async () => {
        await getCategories();
    });
    onUnmounted(() => {
        categoryStore.categories = {};
    });

    const handleDelete = async (id) => {
        const isConfirmed = confirm("Are you sure you want to delete this category?");
    
        if (isConfirmed) {
            await categoryStore.categoriesDelete(id, router);
            await getCategories();
        }
    }
    const resetFilter = async () => {
        filter.value.keyword = '';
        filter.value.from = '';
        filter.value.to = '';

        await getCategories();
    }
</script>