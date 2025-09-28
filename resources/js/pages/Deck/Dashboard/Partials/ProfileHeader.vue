<template>
    <div class="relative overflow-hidden rounded-lg bg-[url('/bg-1.png')] bg-fixed bg-bottom bg-repeat p-8 text-white">
        <div class="relative z-10">
            <div class="mb-8 flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <Avatar class="h-20 w-20 border-4 border-white/20">
                        <AvatarImage :src="user.avatar || ''" alt="Profile" />
                        <AvatarFallback>{{ getInitials(user.name) }}</AvatarFallback>
                    </Avatar>
                    <div>
                        <div class="mb-1 flex items-center gap-2">
                            <h2 class="text-3xl font-semibold">{{ user.name }}</h2>
                            <div class="flex h-6 w-6 items-center justify-center">
                                <LucideIcon name="ShieldCheck" class="fill-blue-400" />
                            </div>
                        </div>
                        <p class="text-lg text-purple-200">@{{ user.username }}</p>
                    </div>
                </div>
                <Badge v-if="user.streamer_level" class="bg-yellow-400 px-4 py-1 text-sm font-medium text-yellow-900 hover:bg-yellow-500">
                    {{ user.streamer_level }}
                </Badge>
            </div>

            <div class="grid grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="mb-1 text-3xl font-bold">{{ user.followers_count }}</div>
                    <div class="text-purple-200">Followers</div>
                </div>
                <div class="text-center">
                    <div class="mb-1 text-3xl font-bold">{{ user.following_count }}</div>
                    <div class="text-purple-200">Following</div>
                </div>
                <div class="text-center">
                    <div class="mb-1 text-3xl font-bold">{{ user.gifts_received }}</div>
                    <div class="text-purple-200">Gift received</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Badge } from '@/components/ui/badge';
import { type Auth, User } from '@/types';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { getInitials } from '@/composables/useInitials';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => (page.props.auth as Auth).user as User);
</script>
