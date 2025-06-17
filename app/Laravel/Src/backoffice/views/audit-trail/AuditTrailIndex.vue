<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Audit Trail /</span> List</h4>
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <form>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Advanced Filters</h5>
                                <div class="row">
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_keyword" class="form-label">Keyword</label>
                                        <input type="text" class="form-control" id="input_keyword" placeholder="e.g, Username, Remarks">
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_from" class="form-label">From</label>
                                        <input class="form-control" type="date" id="input_from">
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_to" class="form-label">To</label>
                                        <input class="form-control" type="date" id="input_to">
                                    </div>
                                </div>
                                <div class="demo-inline-spacing">
                                    <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
                                    <button class="btn btn-sm btn-outline-primary">Reset Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header">Record Data</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Name</th>
                                        <th>IP Address</th>
                                        <th>Action</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            Super Admin
                                            <small>Super Admin</small>
                                        </td>
                                        <td>127.0.0.1</td>
                                        <td>Super Admin has logged in.</td>
                                        <td>10/05/2025 08:51 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding-left: 20px; padding-right: 20px;">
                            <p class="mt-4">Showing 1 to 2 of 2 entries</p>
                            <!-- <Bootstrap5Pagination :data="" @pagination-change-page="" size="small"/> -->
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

    import { RouterLink, useRouter } from 'vue-router';
</script>