<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> Show Details</h4>
            <div class="row justify-content-center">
                <div class="col-lg-7 mb-4 order-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">AI Gemini</h5>
                            <h6 class="card-subtitle text-muted">Juan Dela Cruz</h6>
                        </div>
                        <img class="img-fluid" src="../../assets/images/1.png" alt="Card image cap" style="height: 500px;">
                        <div class="card-body">
                            <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
                            <div class="demo-inline-spacing d-flex justify-content-end">
                                <RouterLink :to="{ name: 'BlogsIndex' }" class="btn btn-outline-secondary">Cancel</RouterLink>
                                <RouterLink :to="{ name: 'BlogsEdit', params: {id: '1'} }" class="btn btn-warning">Edit</RouterLink>
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