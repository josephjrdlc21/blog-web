<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> Change Password</h4>
            <div class="row">
                <div class="col-lg-6 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Choose New Password</h5>
                            <form @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-lg-12 mb-3 form-password-toggle">
                                        <label class="form-label" for="input_current_password">Current Password</label>
                                        <div class="input-group input-group-merge">
                                            <input :type="isCurrentPasswordVisible ? 'password' : 'text'" v-model="profile.current_password" id="input_current_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                            <span class="input-group-text cursor-pointer" @click="toggleCurrentPassword"><i :class="isCurrentPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                                        </div>
                                        <small v-if="errorStore.validations.errors?.current_password" class="text-danger">
                                            {{ errorStore.validations.errors.current_password[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-12 mb-3 form-password-toggle">
                                        <label class="form-label" for="input_password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input :type="isPasswordVisible ? 'password' : 'text'" v-model="profile.password" id="input_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                            <span class="input-group-text cursor-pointer" @click="togglePassword"><i :class="isPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                                        </div>
                                        <small v-if="errorStore.validations.errors?.password" class="text-danger">
                                            {{ errorStore.validations.errors.password[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-12 mb-3 form-password-toggle">
                                        <label class="form-label" for="input_confirm_password">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input :type="isConfirmPasswordVisible ? 'password' : 'text'" v-model="profile.password_confirmation" id="input_confirm_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                            <span class="input-group-text cursor-pointer" @click="toggleConfirmPassword"><i :class="isConfirmPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                                        </div>
                                        <small v-if="errorStore.validations.errors?.password_confirmation" class="text-danger">
                                            {{ errorStore.validations.errors.password_confirmation[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'Index' }" class="btn btn-outline-secondary" @click="errorStore.validations = {}">Cancel</RouterLink>
                                    <button type="submit" class="btn btn-primary">{{ profileStore.isLoading ? 'Loading..' : 'Submit' }}</button>                           
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

    import { useProfileStore } from '../../store/profileStore';
    import { useErrorStore } from '../../store/errorStore';
    import { RouterLink, useRouter } from 'vue-router';
    import { ref } from 'vue';

    const errorStore = useErrorStore();
    const profileStore = useProfileStore();
    const router = useRouter();

    const profile = ref({
        current_password: '',
        password: '',
        password_confirmation: ''
    });

    const handleSubmit = async () => {
        await profileStore.profileUpdatePassword(profile.value, router);
    };

    const isCurrentPasswordVisible = ref(true);
    const isPasswordVisible = ref(true);
    const isConfirmPasswordVisible = ref(true);

    const toggleCurrentPassword = () => {
        isCurrentPasswordVisible.value = !isCurrentPasswordVisible.value;
    };
    const togglePassword = () => {
        isPasswordVisible.value = !isPasswordVisible.value;
    };
    const toggleConfirmPassword = () => {
        isConfirmPasswordVisible.value = !isConfirmPasswordVisible.value;
    };
</script>