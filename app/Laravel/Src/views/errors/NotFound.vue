<template>
    <div class="container-xxl container-p-y h-100 d-flex justify-content-center align-items-center mt-5">
        <div class="misc-wrapper text-center">
            <h2 class="mb-2 mx-2">Page Not Found :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
            <RouterLink :to="{name: 'Index'}" class="btn btn-primary">Back to home</RouterLink>
            <div class="mt-3">
                <img src="../../assets/images/page-misc-error-light.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png">
            </div>
        </div>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';

</script>