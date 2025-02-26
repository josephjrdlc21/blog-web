<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> Users</h4>
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Advanced Filters</h5>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="input_keyword" class="form-label">Keyword</label>
                                    <input type="text" class="form-control" id="input_keyword" placeholder="e.g, Name, Username, Email">
                                </div>
                                <div class="col-lg-3">
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
                            <div class="demo-inline-spacing mt-2">
                                <button type="button" class="btn btn-primary">Apply</button>                            
                                <button type="button" class="btn btn-outline-primary ml-5">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4 order-0">
                    <div class="card">
                        <h5 class="card-header">Users</h5>
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
                                    <tr v-for="user in users.users" :key="user.id">
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}<br>{{ user.username }}</td>
                                        <td>{{ user.status }}</td>
                                        <td>{{ user.type }}</td>
                                        <td>{{ user.last_login_at || 'N/A' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
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
    import { ref, onMounted } from 'vue';
    import axios from 'axios';

    const users = ref({
        users: []
    });

    const getUsers = async () => {
        try {
            const response = await axios.get('http://blog-web.test/api/users');

            users.value.users = response.data.data;
        } catch (error) {
            alert('Error: ' + error.message);
        }
    };

    onMounted(getUsers);
</script>