<template>
    <AuthLayout>
        <Notification />
        <h4 class="mb-2">Forgot Password? 🔒</h4>
        <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
        <form id="formAuthentication" class="mb-3">
            <div class="mb-3">
                <label for="input_email" class="form-label">Email</label>
                <input type="text" class="form-control" id="input_email" placeholder="Enter your email" autofocus="">
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
            <RouterLink :to="{ name: 'AuthLogin' }" class="btn btn-outline-secondary d-grid w-100 mt-3">Back to login</RouterLink>
        </form>
    </AuthLayout>
</template>

<script setup>
    import AuthLayout from '../../layouts/AuthLayout.vue';
    import Notification from '../../components/AppNotification.vue';

    import { RouterLink } from 'vue-router';
</script>