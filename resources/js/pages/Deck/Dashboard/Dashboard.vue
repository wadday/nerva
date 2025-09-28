<template>
    <DeckLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-4 py-2">
            <ProfileHeader />

            <InsightSection />

            <RecentPosts />
        </div>
    </DeckLayout>
</template>

<script setup lang="ts">
import DeckLayout from '@/layouts/app/DeckLayout.vue';
import type { BreadcrumbItem, User } from '@/types';
import deck from '@/routes/deck';
import ProfileHeader from '@/pages/Deck/Dashboard/Partials/ProfileHeader.vue';
import InsightSection from '@/pages/Deck/Dashboard/Partials/InsightSection.vue';
import RecentPosts from '@/pages/Deck/Dashboard/Partials/RecentPosts.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deck',
        href: deck.index().url,
    },
];
</script>
