<template>
    <Head :title="title">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
<!--    <div class="bg-[url('/bg-1.png')] bg-cover bg-bottom bg-no-repeat bg-fixed">-->
    <div>
        <video autoplay muted loop playsinline class="fixed inset-0 object-cover w-full h-screen z-0">
            <source src="/assets/bg-1.mp4" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
        <div class="flex min-h-screen flex-col glass-panel-lg">
            <NervaTopBar />
            <div class="mx-auto flex h-[calc(100vh-140px)] w-full max-w-[1280px] flex-1 gap-8 p-8">
                <NervaNavMenu />
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import NervaTopBar from './partials/NervaTopBar.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import NervaNavMenu from '@/layouts/app/partials/NervaNavMenu.vue';

const page = usePage();
const title = computed(() => (page.props.title ?? '') as string);

</script>
