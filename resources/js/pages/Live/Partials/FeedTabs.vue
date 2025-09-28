<template>
    <div class="space-x-3">
        <Button as-child
                :variant="active === 'live' ? 'secondary' : 'ghost'"
                :class="{'text-white':active !== 'live'}">
            <Link :href="live()">For You</Link>
        </Button>
        <Button as-child
                :variant="active === 'following' ? 'secondary' : 'ghost'"
                :class="{'text-white':active !== 'following'}"
        >
            <Link :href="liveFollowing()">Following</Link>
        </Button>
    </div>
</template>
<script setup lang="ts">
import { live, liveFollowing } from '@/routes';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

defineProps<{
    active: string;
}>();
</script>
