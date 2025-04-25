<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> Users</h4>
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <form @submit.prevent="getUsers">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Advanced Filters</h5>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="input_keyword" class="form-label">Keyword</label>
                                        <input type="text" v-model="filter.keyword" class="form-control" id="input_keyword" placeholder="e.g, Name, Username, Email">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="input_type" class="form-label">Type</label>
                                        <select v-model="filter.type" class="form-select" id="input_type">
                                            <option v-if="userStore.users?.types" v-for="[value, label] in Object.entries(userStore.users.types)" :key="value" :value="value">
                                                {{ label }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="input_status" class="form-label">Status</label>
                                        <select v-model="filter.status" class="form-select" id="input_status">
                                            <option v-if="userStore.users?.statuses" v-for="[value, label] in Object.entries(userStore.users.statuses)" :key="value" :value="value">
                                                {{ label }}
                                            </option> 
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="input_from" class="form-label">From</label>
                                        <input class="form-control" v-model="filter.from" type="date" id="input_from">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="input_to" class="form-label">To</label>
                                        <input class="form-control" v-model="filter.to" type="date" id="input_to">
                                    </div>
                                </div>
                                <div class="demo-inline-spacing">
                                    <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
                                    <button class="btn btn-sm btn-outline-primary" @click="resetFilter">Reset Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Users</h5>
                            <div style="margin-right: 24px;">
                                <RouterLink :to="{ name: 'UsersCreate' }" class="btn btn-primary">Create User</RouterLink>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-if="userStore.isLoading">
                                        <td colspan="6" class="text-center">Loading...</td>
                                    </tr>
                                    <tr v-else-if="!userStore.isLoading && userStore.users.data && userStore.users.data.length" v-for="user in userStore.users.data" :key="user.id">
                                        <td><RouterLink :to="{ name: 'UsersShow', params: {id: user.id} }">{{ user.name }}</RouterLink><br><small>{{ user.username }}</small></td>
                                        <td>{{ user.email }}</td>
                                        <td><StatusBadge :status="user.status"/></td>
                                        <td>{{ user.type }}</td>
                                        <td>{{ user.last_login_at || 'N/A' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" style="" data-bs-popper="static">
                                                    <li><RouterLink :to="{ name: 'UsersShow', params: {id: user.id} }" class="dropdown-item"> View Details</RouterLink></li>
                                                    <li><RouterLink :to="{ name: 'UsersEdit', params: {id: user.id} }" class="dropdown-item"> Edit Details</RouterLink></li>
                                                    <li><button @click="updateUserStatus(user.id)" class="dropdown-item">{{ user.status ==='active' ? 'Deactivate Account' : 'Activate Account' }}</button></li>
                                                    <li><button @click="updateUserPassword(user.id)" class="dropdown-item">Reset Password</button></li>
                                                    <li><button @click="handleDelete(user.id)" class="dropdown-item">Delete User</button></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="6" class="text-center">No records found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding-left: 20px; padding-right: 20px;">
                            <p v-if="!userStore.isLoading" class="mt-4">{{ userStore.paginationRange }}</p>
                            <Bootstrap5Pagination :data="userStore.users" @pagination-change-page="getUsers" size="small"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
    import MainLayout from '../../layouts/MainLayout.vue';
    import StatusBadge from '../../components/AppStatusBadge.vue';
    import Notification from '../../components/AppNotification.vue';

    import { useUserStore } from '../../store/userStore';
    import { useErrorStore } from '../../store/errorStore';
    import { onMounted, onUnmounted, ref } from 'vue';
    import { RouterLink, useRouter } from 'vue-router';
    import { Bootstrap5Pagination } from 'laravel-vue-pagination';

    const userStore = useUserStore();
    const errorStore = useErrorStore();
    const router = useRouter();
    
    const filter = ref({keyword: '', type: '', status: '', from: '', to: '',});

    const getUsers = async (page = 1) => {
        await userStore.usersIndex(page, filter.value);

        filter.value.keyword = userStore.users.keyword || '';
        filter.value.type = userStore.users.type || '';
        filter.value.status = userStore.users.status || '';
        filter.value.from = userStore.users.start_date || '';
        filter.value.to = userStore.users.end_date || '';
    }

    onMounted(async () => {
        await getUsers();
    });
    onUnmounted(() => {
        userStore.isUsersLoaded = false;
        userStore.users = {};
    });

    const updateUserStatus = async (id) => {
        const isConfirmed = confirm("Are you sure you want to change the status of this user?");
    
        if (isConfirmed) {
            await userStore.usersUpdateStatus(id, router);
            await getUsers();
        }
    }
    const updateUserPassword = async (id) => {
        const isConfirmed = confirm("Are you sure you want to reset the password of this user?");
    
        if (isConfirmed) {
            await userStore.usersUpdatePassword(id, router);
            await getUsers();
        }
    }
    const handleDelete = async (id) => {
        const isConfirmed = confirm("Are you sure you want to delete this user?");
    
        if (isConfirmed) {
            await userStore.usersDelete(id, router);
            await getUsers();
        }
    }
    const resetFilter = async () => {
        filter.value.keyword = '';
        filter.value.type = '';
        filter.value.status = '';
        filter.value.from = '';
        filter.value.to = '';

        await getUsers();
    }
</script>