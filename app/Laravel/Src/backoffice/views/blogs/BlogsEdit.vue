<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs /</span> Edit Blog</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Edit Blog</h5>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_image" class="form-label">New Image</label>
                                        <input class="form-control" type="file" id="input_image">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_status" class="form-label">Category</label>
                                        <select class="form-select" id="input_status">
                                            <option>Select Category</option>                                        
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="input_title" placeholder="title">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_excerpt" class="form-label">Excerpt</label>
                                        <input type="text" class="form-control" id="input_excerpt" placeholder="excerpt">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_answer" class="form-label">Content</label>
                                        <QuillEditor theme="snow" style="height: 300px"/>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'BlogsIndex' }" class="btn btn-outline-secondary">Cancel</RouterLink>
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

    import { QuillEditor } from '@vueup/vue-quill';
    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    import { RouterLink } from 'vue-router';
</script>