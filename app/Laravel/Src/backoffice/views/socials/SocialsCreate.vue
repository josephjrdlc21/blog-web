<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Social Media /</span> Create Social Media</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Create Social Media</h5>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_platform" class="form-label">Platform</label>
                                        <input type="text" class="form-control" id="input_platform" placeholder="platform">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_link" class="form-label">Link</label>
                                        <input type="text" class="form-control" id="input_link" placeholder="link">
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'SocialsIndex' }" class="btn btn-outline-secondary">Cancel</RouterLink>
                                    <button type="submit" class="btn btn-primary">Submit</button>                           
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