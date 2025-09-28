<template>
    <div class="slide-in-glass w-full space-y-6">
        <FeedTabs active="following" />

        <Card class="glass-panel-lg h-96 glass-hover">
            <div class="h-full w-full flex items-center justify-center flex-col gap-1">
                <div class="font-bold text-3xl text-white">No LIVE streams for you yet</div>
                <div><small class="text-white text-lg">Go back to explore more songs</small></div>
                <div class="mt-4">
                    <Button v   ariant="secondary" class="px-10 rounded py-5">
                        <Link :href="live()" prefetch>Go back</Link>
                    </Button>
                </div>
            </div>
        </Card>

        <Feeds />
    </div>
</template>

<script setup lang="ts">

import NervaLayout from '@/layouts/app/NervaLayout.vue';
import FeedTabs from './Partials/FeedTabs.vue';
import Feeds from '@/pages/Live/Partials/Feeds.vue';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { live } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineOptions({
    layout: NervaLayout,
})
</script>
