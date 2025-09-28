<script setup lang="ts">
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { type AdminMenuItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import Icon from '@/components/Icon.vue';

defineProps<{
    items: AdminMenuItem[];
}>();

const page = usePage();
</script>

<template>
    <SidebarGroup
        class="px-2 py-0"
        v-for="item in items" :key="item.name"
    >
        <SidebarGroupLabel>{{ item.name }}</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="child in item.children" :key="child.name">
                <SidebarMenuButton
                    as-child
                    :is-active="child.active"
                    :tooltip="child.name"
                >
                    <Link :href="child.route">
                        <Icon :name="child.icon" />
                        <span>{{ child.name }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
