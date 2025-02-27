<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Accounts /</span> <span class="text-muted fw-light">Users /</span>Show Details</h4>
            <div class="row">
                <div class="col-lg-8 col-md-6 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Account Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <h6><b>Name</b></h6>
                                    <p>{{ user.user.name }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Email</b></h6>
                                    <p>{{ user.user.email }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Username</b></h6>
                                    <p>{{ user.user.username }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Type</b></h6>
                                    <p>{{ user.user.type }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Status</b></h6>
                                    <p>{{ user.user.status }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Last Login</b></h6>
                                    <p>{{ user.user.last_login_at || 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Date Registered</b></h6>
                                    <p>{{ user.user.created_at }}</p>
                                </div>
                            </div>
                            <div class="demo-inline-spacing">
                                <RouterLink :to="{ name: 'UsersIndex' }" class="btn btn-outline-secondary">Return to List</RouterLink>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
    import MainLayout from '../../layouts/MainLayout.vue';
    import { RouterLink, useRoute } from 'vue-router';
    import { onMounted, ref } from 'vue';
    import axios from 'axios';

    const route = useRoute();
    const user = ref({
        user: []
    });

    onMounted(async () => {
        try{
            const response = await axios.get(`${API_BASE_URL}/users/show/${route.params.id}`);
        
            user.value.user = response.data.data;
        }catch (error){
            alert('Error: ' + error.message);
        }
    });
</script>