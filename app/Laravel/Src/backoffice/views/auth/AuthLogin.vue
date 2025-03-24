<template>
    <AuthLayout>
        <h4 class="mb-2">Welcome to Sneat! 👋</h4>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>
        <form @submit.prevent="login" id="formAuthentication" class="mb-3">
            <div class="mb-3">
                <label for="email" class="form-label">Email or Username</label>
                <input type="text" v-model="credentials.email" class="form-control" id="email" placeholder="Enter your email or username" autofocus/>
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="#">
                        <small>Forgot Password?</small>
                    </a>
                </div>
                <div class="input-group input-group-merge">
                    <input :type="isPasswordVisible ? 'password' : 'text'" v-model="credentials.password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                    <span class="input-group-text cursor-pointer" @click="togglePassword"><i :class="isPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>
        <p class="text-center">
            <span>New on our platform?</span> 
            <RouterLink :to="{ name: 'AuthRegister' }">
                <span> Create an account</span>
            </RouterLink>
        </p>
    </AuthLayout>
</template>

<script setup>
    import AuthLayout from '../../layouts/AuthLayout.vue';
    
    import { useAuthStore } from '../../store/authStore';
    import { RouterLink, useRouter } from 'vue-router';
    import { ref } from 'vue';

    const authStore = useAuthStore();
    const router = useRouter();

    const isPasswordVisible = ref(true);
    const credentials = ref({email: '', password: ''});

    const togglePassword = () => {
        isPasswordVisible.value = !isPasswordVisible.value;
    };

    const login = async () => {
        if(await authStore.login(credentials.value)) {
            router.replace({ name: 'Index' });
        }
        else{
            router.replace({ name: 'AuthLogin' });
        }
    };
</script>