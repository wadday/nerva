<template>
    <NervaLayout>
        <NervaLeftSidebar />

        <NervaCenterBody />

        <NervaRightSidebar />
    </NervaLayout>
</template>

<script setup lang="ts">
import NervaLayout from '@/layouts/app/NervaLayout.vue';
import NervaLeftSidebar from '@/layouts/app/partials/NervaLeftSidebar.vue';
import NervaRightSidebar from '@/layouts/app/partials/NervaRightSidebar.vue';
import NervaCenterBody from '@/layouts/app/partials/NervaCenterBody.vue';
</script>
