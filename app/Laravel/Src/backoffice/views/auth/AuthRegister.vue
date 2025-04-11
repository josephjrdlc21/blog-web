<template>
    <AuthLayout>
        <Notification />
        <h4 class="mb-2">Adventure starts here 🚀</h4>
        <p class="mb-4">Make your app management easy and fun!</p> 
        <p v-if="authStore.isLoading" >Submitting...</p>
        <form v-else @submit.prevent="register" id="formAuthentication" class="mb-3">
            <div class="row mb-3">
                <div class="col-lg-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" v-model="data.user.username" class="form-control" id="username" placeholder="Username" autofocus/>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.email" class="text-danger">
                        {{ errorStore.validations.errors.username[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" v-model="data.user.email" class="form-control" id="email" placeholder="Email" autofocus/>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.email" class="text-danger">
                        {{ errorStore.validations.errors.email[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" v-model="data.user.firstname" class="form-control" id="firstname" placeholder="Firstname" autofocus/>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.firstname" class="text-danger">
                        {{ errorStore.validations.errors.firstname[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="middlename" class="form-label">Middlename</label>
                    <input type="text" v-model="data.user.middlename" class="form-control" id="middlename" placeholder="Middlename" autofocus/>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.middlename" class="text-danger">
                        {{ errorStore.validations.errors.middlename[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" v-model="data.user.lastname" class="form-control" id="lastname" placeholder="Lastname" autofocus/>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.lastname" class="text-danger">
                        {{ errorStore.validations.errors.lastname[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="suffix" class="form-label">Suffix</label>
                    <input type="text" v-model="data.user.suffix" class="form-control" id="suffix" placeholder="Suffix" autofocus/>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.suffix" class="text-danger">
                        {{ errorStore.validations.errors.suffix[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input :type="isPasswordVisible ? 'password' : 'text'" v-model="data.user.password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer" @click="togglePassword"><i :class="isPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                    </div>
                    <small v-if="errorStore.validations.errors && errorStore.validations.errors.password" class="text-danger">
                        {{ errorStore.validations.errors.password[0] }}
                    </small>
                </div>
                <div class="col-lg-6 mb-3 form-password-toggle">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input :type="isConfirmPasswordVisible ? 'password' : 'text'" v-model="data.user.password_confirmation" id="confirm_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer" @click="toggleConfirmPassword"><i :class="isConfirmPasswordVisible ? 'bx bx-hide' : 'bx bx-show'"></i></span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
        </form>
        <p class="text-center">
            <span>Already have an account?</span>
            <RouterLink :to="{ name: 'AuthLogin' }">
                <span> Sign in instead</span>
            </RouterLink>
        </p>
    </AuthLayout>
</template>

<script setup>
    import AuthLayout from '../../layouts/AuthLayout.vue';
    import Notification from '../../components/AppNotification.vue';

    import { useAuthStore } from '../../store/authStore';
    import { useErrorStore } from '../../store/errorStore';
    import { RouterLink, useRouter } from 'vue-router';
    import { ref } from 'vue';

    const authStore = useAuthStore();
    const errorStore = useErrorStore();
    const router = useRouter();

    const data = ref({
        user: {
            username: '',
            email: '',
            firstname: '',
            middlename: '',
            lastname: '',
            suffix: '',
            password: '',
            password_confirmation: ''
        }
    });
    const isPasswordVisible = ref(true);
    const isConfirmPasswordVisible = ref(true);

    const register = async () => {
        await authStore.register(data.value.user, router);
    };
    const togglePassword = () => {
        isPasswordVisible.value = !isPasswordVisible.value;
    };
    const toggleConfirmPassword = () => {
        isConfirmPasswordVisible.value = !isConfirmPasswordVisible.value;
    };
</script>