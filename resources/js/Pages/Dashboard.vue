<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import JobList from '@/Components/Dashboard/JobList.vue';

defineProps({
    jobs: Array
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5">
                <!-- TODO: Add job list here -->
                 <JobList :jobs="jobs" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
