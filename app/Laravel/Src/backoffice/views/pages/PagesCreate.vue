<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Pages /</span> Create Page</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Create Page</h5>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_page" class="form-label">Page</label>
                                        <select class="form-select" id="input_type">
                                            <option>Select Type</option>                                        
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="input_title" placeholder="title">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_title" class="form-label">Content</label>
                                        <input type="text" class="form-control" id="input_content" placeholder="content">
                                    </div>
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