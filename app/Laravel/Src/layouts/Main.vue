<template>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <Sidebar/>
            <div class="layout-page">
                <Topbar/>
                <div class="content-wrapper">
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Sidebar from '../components/Sidebar.vue';
    import Topbar from '../components/Topbar.vue';
</script>