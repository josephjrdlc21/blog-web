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
                                    <p>{{ data.user.name }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Email</b></h6>
                                    <p>{{ data.user.email }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Username</b></h6>
                                    <p>{{ data.user.username }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Type</b></h6>
                                    <p>{{ data.user.type }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Status</b></h6>
                                    <p>{{ data.user.status }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Last Login</b></h6>
                                    <p>{{ data.user.last_login_at || 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6><b>Date Registered</b></h6>
                                    <p>{{ data.user.created_at }}</p>
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
    import { RouterLink, useRoute, useRouter } from 'vue-router';
    import { onMounted, ref } from 'vue';
    import axios from 'axios';

    const router = useRouter();
    const route = useRoute();
    const data = ref({
        user: []
    });

    onMounted(async () => {
        try{
            const response = await axios.get(`${API_BASE_URL}/users/show/${route.params.id}`);
            
            data.value.user = response.data.data;
        }catch(error){
            router.push({ name: 'UsersIndex' });
            alert('Error: ' + error.response.data.msg);
        }
    });
</script>