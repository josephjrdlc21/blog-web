<template>
    <AuthLayout>
        <h4 class="mb-2">Adventure starts here 🚀</h4>
        <p class="mb-4">Make your app management easy and fun!</p> 
        <form id="formAuthentication" class="mb-3" action="" method="POST">
            <div class="row mb-3">
                <div class="col-lg-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus/>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" autofocus/>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" autofocus/>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="middlename" class="form-label">Middlename</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middlename" autofocus/>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" autofocus/>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="suffix" class="form-label">Suffix</label>
                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix" autofocus/>
                </div>
                <div class="col-lg-6 mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>
                <div class="col-lg-6 mb-3 form-password-toggle">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary d-grid w-100">Sign up</button>
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

    import { RouterLink } from 'vue-router';
</script>