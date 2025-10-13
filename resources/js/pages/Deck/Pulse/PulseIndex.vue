<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="flex justify-between items-center">
                <h1>Pulses</h1>
                <Button as-child variant="ghost" class="rounded-full">
                    <Link :href="deck.pulse.create()">
                        Create Pulse
                    </Link>
                </Button>
            </div>
            <Card class="glass-panel-lg rounded-2xl p-6 flex flex-col">
                <div class="h-screen ">ww</div>
            </Card>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import DeckLayout from '@/layouts/app/DeckLayout.vue';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import deck from '@/routes/deck'
import LucideIcon from '@/components/icon/LucideIcon.vue';
import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deck',
        href: deck.index().url,
    },
    {
        title: 'Pulse',
        href: deck.pulse.index().url,
    },
];
</script>
