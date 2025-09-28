<template>
    <div class="flex">
        <div class="glass-panel mb-2 rounded-xl mx-auto max-w-7xl">
            <div class="flex h-16 items-center px-4">
                <Link :href="index()" class="flex items-center gap-x-2">
                    <AppLogo />
                </Link>
                <Separator orientation="vertical" class="mx-4 bg-white/10" />
                <div class="h-full flex flex-1">
                    <NavigationMenu :viewport="false" class="flex h-full items-stretch">
                        <NavigationMenuList class="flex h-full items-stretch space-x-2">
                            <NavigationMenuItem v-for="menu in mainMenu" class="relative flex h-full items-center" :key="'bottom-menu-' + menu.name">
                                <Tooltip>
                                    <TooltipTrigger as-child placement="top">
                                        <Link :href="menu.route" class="relative glass-panel glass-hover group flex gap-x-3 rounded-md p-3">
                                            <LucideIcon :name="menu.icon" :class="{'text-cyan-400': menu.active}" />
                                        </Link>
                                    </TooltipTrigger>
                                    <TooltipContent class="glass-panel mb-2 text-gray-500 dark:text-gray-200" side="top" align="center" arrowClass="!hidden">
                                        <span class="text-lg font-semibold">{{ menu.name }}</span>
                                    </TooltipContent>
                                </Tooltip>
                                <div class="absolute -bottom-1 inset-x-0 flex items-end justify-center"
                                     v-if="menu.active">
                                    <LucideIcon name="Dot" class="text-cyan-400" />
                                </div>
                            </NavigationMenuItem>
                        </NavigationMenuList>
                    </NavigationMenu>
                </div>
                <Separator orientation="vertical" class="mx-4 bg-white/10" />
                <div class="flex items-center space-x-2">
                    <div class="relative flex items-center space-x-3">
                        <NavigationMenu :viewport="false" class="flex h-full items-stretch">
                            <NavigationMenuList class="flex h-full items-stretch space-x-2">
                                <NavigationMenuItem class="relative flex h-full items-center">
                                    <Tooltip>
                                        <TooltipTrigger as-child placement="top">
                                            <div class="glass-panel glass-hover group flex gap-x-3 rounded-md p-3">
                                                <LucideIcon name="Search" />
                                            </div>
                                        </TooltipTrigger>
                                        <TooltipContent class="glass-panel mb-2 text-gray-500 dark:text-gray-200" side="top" align="center" arrowClass="!hidden">
                                            <span class="text-lg font-semibold ">Search</span>
                                        </TooltipContent>
                                    </Tooltip>
                                </NavigationMenuItem>
                            </NavigationMenuList>
                        </NavigationMenu>

                        <DropdownMenu>
                            <DropdownMenuTrigger :as-child="true">
                                <NavigationMenu :viewport="false" class="flex h-full items-stretch">
                                    <NavigationMenuList class="flex h-full items-stretch space-x-2">
                                        <NavigationMenuItem class="relative flex h-full items-center">
                                            <div class="glass-panel glass-hover group flex gap-x-3 rounded-md p-1">
                                            <Avatar class="rounded h-10 w-10">
                                                <AvatarImage
                                                    v-if="auth.user.avatar"
                                                    :src="auth.user.avatar"
                                                    :alt="auth.user.name"
                                                />
                                                <AvatarFallback class="bg-transparent">
                                                    {{ getInitials(auth.user?.name) }}
                                                </AvatarFallback>
                                            </Avatar>
                                            </div>
                                        </NavigationMenuItem>
                                    </NavigationMenuList>
                                </NavigationMenu>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="end" class="w-56 glass-panel mb-3">
                                <UserMenuContent :user="auth.user" />
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
import {
    NavigationMenu,
    NavigationMenuItem,
    NavigationMenuList,
} from '@/components/ui/navigation-menu';
import { Separator } from '@/components/ui/separator';
import { computed } from 'vue';
import { AdminMenuChild, Auth } from '@/types';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { index } from '@/routes/deck';
import { Tooltip, TooltipContent, TooltipTrigger } from '@/components/ui/tooltip';
import { getInitials } from '@/composables/useInitials';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import UserMenuContent from '@/components/UserMenuContent.vue';

const page = usePage();

const mainMenu = computed(() => page.props.primary_menu as AdminMenuChild[]);
const auth = computed(() => page.props.auth as Auth);
</script>
