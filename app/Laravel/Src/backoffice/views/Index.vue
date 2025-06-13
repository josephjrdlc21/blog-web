<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Data</h4>
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                    <p class="mb-4">
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                    </p>
                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Blogs</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/images/man-with-laptop-light.png" height="140" alt="View Badge User"/>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Total Users</span>
                            <h3 class="text-success card-title mb-2">500</h3>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Total Blogs</span>
                            <h3 class="text-info card-title mb-2">1000</h3>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Total Categories</span>
                            <h3 class="text-warning card-title mb-2">7</h3>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Total Visitors Today</span>
                            <h3 class="text-primary card-title mb-2">1000</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12-mb-3">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Recent Blogs</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Technology AI</td>
                                        <td>John Doe</td>
                                        <td>10/05/2025 08:51 PM</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" style="" data-bs-popper="static">
                                                    <li><RouterLink to="" class="dropdown-item"> View Details</RouterLink></li>
                                                </ul>
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
    import MainLayout from '../layouts/MainLayout.vue';
    import Notification from '../components/AppNotification.vue';

    import { useAuthStore } from '../store/authStore';

    const authStore = useAuthStore();
</script>