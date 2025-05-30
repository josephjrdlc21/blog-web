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
                            <img :src="avatarUrl" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg" @change="onFileChange" ref="fileInput">
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" @click="resetImage">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <form @submit.prevent="handleSubmit">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="input_firstname" class="form-label">First Name</label>
                                    <input class="form-control" type="text" v-model="profile.firstname" id="input_firstname" placeholder="firstname">
                                    <small v-if="errorStore.validations.errors?.firstname" class="text-danger">
                                        {{ errorStore.validations.errors.firstname[0] }}
                                    </small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="input_lastname" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" v-model="profile.lastname" id="input_lastname" placeholder="lastname">
                                    <small v-if="errorStore.validations.errors?.lastname" class="text-danger">
                                        {{ errorStore.validations.errors.lastname[0] }}
                                    </small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="input_middlename" class="form-label">Middlename</label>
                                    <input class="form-control" type="text" v-model="profile.middlename" id="input_middlename" placeholder="middlename">
                                    <small v-if="errorStore.validations.errors?.middlename" class="text-danger">
                                        {{ errorStore.validations.errors.middlename[0] }}
                                    </small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="input_suffix" class="form-label">Suffix</label>
                                    <input class="form-control" type="text" v-model="profile.suffix" id="input_suffix" placeholder="suffix">
                                    <small v-if="errorStore.validations.errors?.suffix" class="text-danger">
                                        {{ errorStore.validations.errors.suffix[0] }}
                                    </small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="input_username" class="form-label">Username</label>
                                    <input class="form-control" type="text" v-model="profile.username" id="input_username" placeholder="username">
                                    <small v-if="errorStore.validations.errors?.username" class="text-danger">
                                        {{ errorStore.validations.errors.username[0] }}
                                    </small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="input_email" class="form-label">Email</label>
                                    <input class="form-control" type="text" v-model="profile.email" id="input_email" placeholder="email">
                                    <small v-if="errorStore.validations.errors?.email" class="text-danger">
                                        {{ errorStore.validations.errors.email[0] }}
                                    </small>
                                </div>
                            </div>
                            <div class="demo-inline-spacing d-flex justify-content-end">
                                <RouterLink :to="{ name: 'Index' }" class="btn btn-outline-secondary" @click="errorStore.validations = {}">Cancel</RouterLink>
                                <button type="submit" class="btn btn-primary me-2">{{ profileStore.isLoading ? 'Loading..' : 'Save changes' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script setup>
    import MainLayout from '../../layouts/MainLayout.vue';
    import Notification from '../../components/AppNotification.vue';
    import defaultAvatar from '../../assets/images/1.png';

    import { useProfileStore } from '../../store/profileStore';
    import { useErrorStore } from '../../store/errorStore';
    import { onMounted, onUnmounted, ref } from 'vue';
    import { RouterLink, useRoute, useRouter } from 'vue-router';

    const errorStore = useErrorStore();
    const profileStore = useProfileStore();
    const router = useRouter();

    const profile = ref({
        firstname: '',
        lastname: '',
        middlename: '',
        suffix: '',
        username: '',
        email: ''
    });

    onMounted(async () => {
        await profileStore.profileIndex();

        profile.value = {
            firstname: profileStore.profile.firstname,
            lastname: profileStore.profile.lastname,
            middlename: profileStore.profile.middlename,
            suffix: profileStore.profile.suffix,
            username: profileStore.profile.username,
            email: profileStore.profile.email
        };
    });
    onUnmounted(() => {
        profileStore.profile = {};
    });

    const handleSubmit = async () => {
        await profileStore.profileUpdate(profile.value, router);
    };

    const fileInput = ref(null);
    const avatarUrl = ref(defaultAvatar);
    const onFileChange = ({ target: { files } }) => {
        if (files?.[0]) {
            avatarUrl.value = URL.createObjectURL(files[0]);
        }
    };
    const resetImage = () => {
        fileInput.value.value = '';
        avatarUrl.value = defaultAvatar;
    };
</script>