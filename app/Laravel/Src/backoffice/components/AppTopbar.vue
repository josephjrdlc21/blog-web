<template>
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none" @click="expandMenu">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..."/>
                </div>
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <RouterLink :to="{ name: 'ProfileIndex' }" class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img :src="avatar" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </RouterLink>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <RouterLink :to="{ name: 'ProfileIndex' }" class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img :src="avatar" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span v-if="authStore.user" class="fw-semibold d-block">{{ authStore.user }}</span>
                                    <span v-else class="fw-semibold d-block">NAME</span>
                                    <small class="text-muted">Admin</small>
                                </div>
                            </div>
                            </RouterLink>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <RouterLink :to="{ name: 'ProfileIndex' }" class="dropdown-item">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">Profile</span>
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink :to="{ name: 'ProfileChangePassword' }" class="dropdown-item">
                                <i class="bx bx-lock me-2"></i>
                                <span class="align-middle">Change Password</span>
                            </RouterLink>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <button @click="logout" class="dropdown-item" href="auth-login-basic.html">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
    import defaultAvatar from '../assets/images/1.png';

    import { useAuthStore } from '../store/authStore';

    import { RouterLink, useRouter } from 'vue-router';
    import { ref } from 'vue';

    const authStore = useAuthStore();
    const router = useRouter();

    const avatar = ref(authStore.avatar || defaultAvatar);

    const expandMenu = () => {
        document.documentElement.className = 'light-style layout-menu-fixed layout-menu-expanded';
    };

    const logout = async () => {
        if(await authStore.logout()){
            router.replace({ name: 'AuthLogin' });
        }
    };
</script>