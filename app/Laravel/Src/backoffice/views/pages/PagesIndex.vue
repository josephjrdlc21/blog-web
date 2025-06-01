<template>
    <MainLayout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <Notification />
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS /</span> <span class="text-muted fw-light">Pages /</span> List</h4>
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <form>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Advanced Filters</h5>
                                <div class="row">
                                    <div class="col-lg-4 mt-3">
                                        <label for="input_keyword" class="form-label">Keyword</label>
                                        <select class="form-select" id="input_type">
                                            <option>Select Type</option>                                        
                                        </select>
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
                            <div style="margin-right: 24px;">
                                <RouterLink :to="{ name: 'PagesCreate' }" class="btn btn-primary">Create Page</RouterLink>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Page</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-primary">About Us</td>
                                        <td>MASTER ADMIN</td>
                                        <td>10/05/2025 08:51 PM</td>
                                        <td>10/05/2025 08:51 PM</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" style="" data-bs-popper="static">
                                                    <li><RouterLink to="" class="dropdown-item"> View Details</RouterLink></li>
                                                    <li><RouterLink to="" class="dropdown-item"> Edit Details</RouterLink></li>
                                                    <li><button class="dropdown-item"> Delete Category</button></li>
                                                </ul>
                                            </div>
                                        </td>
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
</script>