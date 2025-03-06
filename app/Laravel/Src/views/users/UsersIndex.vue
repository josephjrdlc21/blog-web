<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> Users</h4>
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Advanced Filters</h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="input_keyword" class="form-label">Keyword</label>
                                    <input type="text" class="form-control" id="input_keyword" placeholder="e.g, Name, Username, Email">
                                </div>
                                <div class="col-lg-2">
                                    <label for="input_type" class="form-label">Type</label>
                                    <input type="text" class="form-control" id="input_type" placeholder="All">
                                </div>
                                <div class="col-lg-2">
                                    <label for="input_status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="input_status" placeholder="All">
                                </div>
                                <div class="col-lg-2">
                                    <label for="input_from" class="form-label">From</label>
                                    <input class="form-control" type="date" value="2021-06-18" id="input_from">
                                </div>
                                <div class="col-lg-2">
                                    <label for="input_to" class="form-label">To</label>
                                    <input class="form-control" type="date" value="2021-06-18" id="input_to">
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <tr v-if="userStore.users.length" v-for="user in userStore.users" :key="user.id">
                                        <td>{{ user.name }}<br><small>{{ user.username }}</small></td>
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
                                                    <li><button @click="handleDelete(user.id)" class="dropdown-item">Delete User</button></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="6" class="text-center">No records found</td>
                                    </tr>
                                </tbody>
                            </table>
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
    import { onMounted, onUnmounted } from 'vue';
    import { RouterLink, useRoute, useRouter } from 'vue-router';

    const userStore = useUserStore();
    const route = useRoute();
    const router = useRouter();

    onMounted(async () => {
        await userStore.usersIndex();
    });

    onUnmounted(() => {
        userStore.users = [];
    });

    const handleDelete = async (id) => {
        const isConfirmed = confirm("Are you sure you want to delete this user?");
    
        if (isConfirmed) {
            await userStore.usersDelete(id, router);
        }    
    }
</script>