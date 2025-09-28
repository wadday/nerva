<template>
    <TooltipProvider :delay-duration="0">
        <div class="relative flex h-screen w-full flex-col bg-[url('/deck-bg-2.png')] dark:bg-[url('/deck-dark-bg.png')] bg-bottom bg-repeat bg-fixed">
            <div class="absolute top-8 left-8 z-10">
                <div class="flex items-center gap-x-2 group">
                    <div class="w-4 h-4 rounded-full bg-red-500 flex items-center justify-center pt-px ">
                        <LucideIcon name="X" class="hidden group-hover:block h-4 w-4 text-gray-600" />
                    </div>
                    <div class="w-4 h-4 rounded-full bg-yellow-500 flex items-center justify-center pt-px pl-px">
                        <LucideIcon name="Minus" class="hidden group-hover:block h-4 w-3 text-gray-600" />
                    </div>
                    <div class="w-4 h-4 rounded-full bg-green-500 flex items-center justify-center pt-px pl-px">
                        <LucideIcon name="ChevronsUpDown" class="hidden group-hover:block h-4 w-4 -rotate-45 text-gray-600" />
                    </div>
                </div>
            </div>
            <main class="bg-[#f3f4f8] dark:bg-gray-800/10 backdrop-blur border border-white/20 dark:border-white/10 m-5 h-screen overflow-auto rounded-2xl relative">
                <div class="mx-auto w-full max-w-7xl">
                    <div class="flex items-center justify-between py-3">
                        <template v-if="breadcrumbs && breadcrumbs.length > 0">
                            <Breadcrumbs :breadcrumbs="breadcrumbs" />
                        </template>
                        <div>
                            <slot name="action" />
                        </div>
                    </div>
                    <slot v-bind="forward" />
                </div>
            </main>
            <NervaDock />
        </div>
    </TooltipProvider>
</template>

<script setup lang="ts">
import NervaDock from '@/layouts/app/partials/NervaDock.vue';
import { TooltipProvider } from 'reka-ui';
import type { Auth, BreadcrumbItemType, User } from '@/types';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import LucideIcon from '@/components/icon/LucideIcon.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const user = computed(() => (page.props.auth as Auth).user as User);
const forward = computed(() => ({
    user: user.value as User,
}));


</script>
