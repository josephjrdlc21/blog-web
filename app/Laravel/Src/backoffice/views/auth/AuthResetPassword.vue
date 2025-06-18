<template>
    <AuthLayout>
        <Notification />
        <h4 class="mb-2">Reset Password 🔒</h4>
        <p class="mb-4">Enter your new password this will expire in 5 mnitues</p>
        <form id="formAuthentication" class="mb-3">
            <div class="row">
                <div class="col-lg-12 mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input :type="isPasswordVisible ? 'password' : 'text'" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer" @click="togglePassword"><i :class="isPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                    </div>
                </div>
                <div class="col-lg-12 mb-3 form-password-toggle">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input :type="isConfirmPasswordVisible ? 'password' : 'text'" id="confirm_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer" @click="toggleConfirmPassword"><i :class="isConfirmPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
            <RouterLink :to="{ name: 'AuthLogin' }" class="btn btn-outline-secondary d-grid w-100 mt-3">Back to login</RouterLink>
        </form>
    </AuthLayout>
</template>

<script setup>
    import AuthLayout from '../../layouts/AuthLayout.vue';
    import Notification from '../../components/AppNotification.vue';

    import { RouterLink } from 'vue-router';
    import { ref } from 'vue';

    const isPasswordVisible = ref(true);
    const isConfirmPasswordVisible = ref(true);

    const togglePassword = () => {
        isPasswordVisible.value = !isPasswordVisible.value;
    };
    const toggleConfirmPassword = () => {
        isConfirmPasswordVisible.value = !isConfirmPasswordVisible.value;
    };
</script>