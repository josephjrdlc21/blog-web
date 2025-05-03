<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Categories /</span> Edit Category</h4>
            <div class="row">
                <div class="col-lg-6 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Edit Category</h5>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_category" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="input_category" placeholder="category">
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'CategoriesIndex' }" class="btn btn-outline-secondary">Cancel</RouterLink>
                                    <button type="submit" class="btn btn-primary">Save</button>                           
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
    
</script>