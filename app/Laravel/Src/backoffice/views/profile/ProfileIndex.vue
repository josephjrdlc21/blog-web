<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> Account</h4>
            <form>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../../assets/images/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="input_firstname" class="form-label">First Name</label>
                                <input class="form-control" type="text" id="input_firstname" placeholder="firstname">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="input_lastname" class="form-label">Last Name</label>
                                <input class="form-control" type="text" id="input_lastname" placeholder="lastname">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="input_middlename" class="form-label">Middlename</label>
                                <input class="form-control" type="text" id="input_middlename" placeholder="middlename">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="input_suffix" class="form-label">Suffix</label>
                                <input class="form-control" type="text" id="input_suffix" placeholder="suffix">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="input_username" class="form-label">Username</label>
                                <input class="form-control" type="text" id="input_username" placeholder="username">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="input_email" class="form-label">Email</label>
                                <input class="form-control" type="text" id="input_email" placeholder="email">
                            </div>
                        </div>
                        <div class="demo-inline-spacing d-flex justify-content-end">
                            <RouterLink :to="{ name: 'Index' }" class="btn btn-outline-secondary" @click="errorStore.validations = {}">Cancel</RouterLink>
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script setup>
    import MainLayout from '../../layouts/MainLayout.vue';
    import Notification from '../../components/AppNotification.vue';

    import { useErrorStore } from '../../store/errorStore';

    const errorStore = useErrorStore();
</script>