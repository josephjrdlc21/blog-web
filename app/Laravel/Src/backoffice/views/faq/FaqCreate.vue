<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">FAQ /</span> Create FAQ</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Create FAQ</h5>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_question" class="form-label">Question</label>
                                        <input type="text" class="form-control" id="input_question" placeholder="question">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_answer" class="form-label">Answer</label>
                                        <QuillEditor theme="snow" style="height: 300px"/>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'FaqIndex' }" class="btn btn-outline-secondary">Cancel</RouterLink>
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

    import { QuillEditor } from '@vueup/vue-quill';
    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    import { RouterLink } from 'vue-router';
</script>