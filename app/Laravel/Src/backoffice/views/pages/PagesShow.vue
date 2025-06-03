<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Pages /</span> Show Details</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">About Us</h5>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div>Content</div>
                                </div>
                            </div>
                            <div class="demo-inline-spacing d-flex justify-content-end">
                                <RouterLink :to="{ name: 'PagesIndex' }" class="btn btn-outline-secondary">Cancel</RouterLink>
                                <RouterLink :to="{ name: 'PagesEdit', params: {id: '1'} }" class="btn btn-warning">Edit</RouterLink>
                                <button type="submit" class="btn btn-primary">Submit</button>                           
                            </div>
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