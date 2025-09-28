<template>
    <DeckLayout :breadcrumbs="breadcrumbs">
        <template #action>
            <div>
                <Button as-child>
                    <Link :href="deck.pulse.create()">
                        Create Pulse
                    </Link>
                </Button>
            </div>
        </template>
        <div class="space-y-4 py-2">
            <Card class="glass-panel-lg rounded-2xl p-6 h-[500px] flex flex-col">
                <div class="h-screen">ww</div>
            </Card>
        </div>
    </DeckLayout>
</template>

<script setup lang="ts">
import DeckLayout from '@/layouts/app/DeckLayout.vue';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import deck from '@/routes/deck'
import LucideIcon from '@/components/icon/LucideIcon.vue';
import type { BreadcrumbItem } from '@/types';

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
