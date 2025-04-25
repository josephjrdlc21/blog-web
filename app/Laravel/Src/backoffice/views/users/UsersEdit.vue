<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> <span class="text-muted fw-light">Users /</span>Edit User</h4>
            <div class="row">
                <div class="col-lg-8 col-md-6 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Edit User</h5>
                            <form @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_firstname" class="form-label">First Name</label>
                                        <input type="text" v-model="data.user.firstname" class="form-control" id="input_firstname" placeholder="firstname">
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.firstname" class="text-danger">
                                            {{ errorStore.validations.errors.firstname[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_middlename" class="form-label">Middlename</label>
                                        <input type="text" v-model="data.user.middlename" class="form-control" id="input_middlename" placeholder="middlename">
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.middlename" class="text-danger">
                                            {{ errorStore.validations.errors.middlename[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_lastname" class="form-label">Last Name</label>
                                        <input type="text" v-model="data.user.lastname" class="form-control" id="input_lastname" placeholder="lastname">
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.lastname" class="text-danger">
                                            {{ errorStore.validations.errors.lastname[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_suffix" class="form-label">Suffix</label>
                                        <input type="text" v-model="data.user.suffix" class="form-control" id="input_suffix" placeholder="suffix">
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.suffix" class="text-danger">
                                            {{ errorStore.validations.errors.suffix[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_username" class="form-label">Username</label>
                                        <input type="text" v-model="data.user.username" class="form-control" id="input_username" placeholder="username">
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.username" class="text-danger">
                                            {{ errorStore.validations.errors.username[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="input_type" class="form-label">Account Type</label>
                                        <select v-model="data.user.type" class="form-select" id="input_type">
                                            <option v-for="type in data.types" :key="type.value" :value="type.value">{{ type.label }}</option>                                        
                                        </select>
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.type" class="text-danger">
                                            {{ errorStore.validations.errors.type[0] }}
                                        </small>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="input_email" class="form-label">Email</label>
                                        <input type="text" v-model="data.user.email" class="form-control" id="input_email" placeholder="email">
                                        <small v-if="errorStore.validations.errors && errorStore.validations.errors.email" class="text-danger">
                                            {{ errorStore.validations.errors.email[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="demo-inline-spacing d-flex justify-content-end">
                                    <RouterLink :to="{ name: 'UsersIndex' }" class="btn btn-outline-secondary" @click="errorStore.validations = {}">Cancel</RouterLink>
                                    <button type="submit" class="btn btn-primary">{{userStore.isLoading ? 'Updating...' : 'Save' }}</button>                           
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

    import { useUserStore } from '../../store/userStore';
    import { useErrorStore } from '../../store/errorStore';
    import { RouterLink, useRoute, useRouter } from 'vue-router';
    import { onMounted, onUnmounted, ref } from 'vue';

    const userStore = useUserStore();
    const errorStore = useErrorStore();
    const router = useRouter();
    const route = useRoute();

    const data = ref({
        types : [
            { value: "", label: "Select Account Type"},
            { value: "admin", label: "Admin"},
            { value: "author", label: "Author"},
        ],
        user : {
            id: '',
            firstname: '',
            middlename: '',
            lastname: '',
            suffix: '',
            username: '',
            type: '',
            email: '',
        },
    });

    onMounted(async () => {
        await userStore.usersEdit(route.params.id, router);
        
        data.value.user.id = userStore.user.id;
        data.value.user.firstname = userStore.user.firstname;
        data.value.user.middlename = userStore.user.middlename;
        data.value.user.lastname = userStore.user.lastname;
        data.value.user.suffix = userStore.user.suffix;
        data.value.user.username = userStore.user.username;
        data.value.user.type = userStore.user.type;
        data.value.user.email = userStore.user.email;
    });
    onUnmounted(() => {
        userStore.user = {};
    });

    const handleSubmit = async () => {
        await userStore.usersUpdate(data.value.user.id, data.value.user, router);
    }
</script>