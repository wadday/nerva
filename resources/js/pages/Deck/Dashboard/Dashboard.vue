<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <ProfileHeader />

            <InsightSection />

            <RecentPosts />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import type { BreadcrumbItem, User } from '@/types';
import deck from '@/routes/deck';
import ProfileHeader from '@/pages/Deck/Dashboard/Partials/ProfileHeader.vue';
import InsightSection from '@/pages/Deck/Dashboard/Partials/InsightSection.vue';
import RecentPosts from '@/pages/Deck/Dashboard/Partials/RecentPosts.vue';
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deck',
        href: deck.index().url,
    },
];
</script>
