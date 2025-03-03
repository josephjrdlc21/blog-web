<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> <span class="text-muted fw-light">Users /</span>Create User</h4>
            <div class="row">
                <div class="col-lg-8 col-md-6 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Create User</h5>
                            <form @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_firstname" class="form-label">First Name</label>
                                        <input type="text" v-model="user.firstname" class="form-control" id="input_firstname" placeholder="firstname">
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.firstname" class="text-danger">{{ userStore.errors.errors.firstname[0] }}</small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_middlename" class="form-label">Middlename</label>
                                        <input type="text" v-model="user.middlename" class="form-control" id="input_middlename" placeholder="middlename">
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.middlename" class="text-danger">{{ userStore.errors.errors.middlename[0] }}</small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_lastname" class="form-label">Last Name</label>
                                        <input type="text" v-model="user.lastname" class="form-control" id="input_lastname" placeholder="lastname">
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.lastname" class="text-danger">{{ userStore.errors.errors.lastname[0] }}</small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_suffix" class="form-label">Suffix</label>
                                        <input type="text" v-model="user.suffix" class="form-control" id="input_suffix" placeholder="suffix">
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.suffix" class="text-danger">{{ userStore.errors.errors.suffix[0] }}</small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_username" class="form-label">Username</label>
                                        <input type="text" v-model="user.username" class="form-control" id="input_username" placeholder="username">
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.username" class="text-danger">{{ userStore.errors.errors.username[0] }}</small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_type" class="form-label">Account Type</label>
                                        <select v-model="user.type" class="form-select" id="input_type">
                                            <option v-for="type in accountTypes" :key="type.value" :value="type.value">{{ type.label }}</option>                                        
                                        </select>
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.username" class="text-danger">{{ userStore.errors.errors.username[0] }}</small>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_email" class="form-label">Email</label>
                                        <input type="text" v-model="user.email" class="form-control" id="input_email" placeholder="email">
                                        <small v-if="userStore.errors.errors && userStore.errors.errors.username" class="text-danger">{{ userStore.errors.errors.username[0] }}</small>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'UsersIndex' }" class="btn btn-outline-secondary" @click="userStore.errors = {}">Cancel</RouterLink>
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

    import { useUserStore } from '../../store/userStore';
    import { RouterLink, useRouter } from 'vue-router';
    import { onMounted, ref } from 'vue';

    const userStore = useUserStore();
    const router = useRouter();

    onMounted(() => {
        userStore.user = {};
    });

    const accountTypes = ref([
        { value: "", label: "Select Account Type"},
        { value: "admin", label: "Admin"},
        { value: "author", label: "Author"},
    ]);

    const user = ref({
        firstname: '',
        middlename: '',
        lastname: '',
        suffix: '',
        username: '',
        type: '',
        email: '',
    });

    const handleSubmit = async () => {
        await userStore.usersCreate(user.value);

        if(Object.keys(userStore.user).length > 0){
            router.replace({ name: 'UsersIndex' });
        }
    }
</script>