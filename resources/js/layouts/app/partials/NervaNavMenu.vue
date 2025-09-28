<template>
    <div class="slide-in-glass w-full max-w-80">
        <div class="sticky top-24 space-y-6">
            <div>
                <div class="animate-float">
                    <div class="relative">
                        <LucideIcon name="Search" class="glass-text-muted absolute left-3 top-1/2 z-10 h-4 w-4 -translate-y-1/2 transform" />
                        <Input
                            placeholder="Search artists, tracks..."
                            class="glass-panel glass-text-primary rounded-full border-white/10 bg-white/5 py-5 pl-10 placeholder:text-white/50"
                        />
                    </div>
                </div>
                <Card class="animate-float ring-none gap-0 border-none bg-transparent shadow-none">
                    <Link
                        v-for="item in items"
                        :key="'nav-' + item.route"
                        class="glass-hover rounded-lg p-3 text-white"
                        :href="item.route"
                        :class="{ '!text-cyan-400': item.active }"
                    >
                        <div class="flex items-center gap-3">
                            <div>
                                <LucideIcon :name="item.icon" />
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="text-md truncate font-medium transition-colors group-hover:text-cyan-300">
                                    {{ item.name }}
                                </p>
                            </div>
                        </div>
                    </Link>
                </Card>
                <div v-if="!auth.user">
                    <LoginModal>
                        <Button class="block w-full bg-cyan-400">Login</Button>
                    </LoginModal>
                </div>
            </div>
            <Card class="glass-panel-lg glass-hover animate-float4 rounded-2xl p-4">
                <div class="mb-0 flex items-center gap-3">
                    <LucideIcon name="Zap" class="h-5 w-5 text-yellow-400" />
                    <h2 class="glass-text-primary font-semibold">Trending Tracks</h2>
                </div>

                <div class="space-y-3">
                    <div v-for="(track, i) in topTracks" :key="'top-track-' + i" class="glass-panel glass-hover group rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div class="min-w-0 flex-1">
                                <p class="glass-text-primary truncate text-sm font-medium transition-colors group-hover:text-indigo-300">
                                    {{ track.title }}
                                </p>
                                <p class="glass-text-muted truncate text-xs">
                                    {{ track.artist }}
                                </p>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="glass-text-secondary text-xs">
                                    {{ track.plays }}
                                </p>
                                <p class="glass-text-muted text-xs">
                                    {{ track.duration }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </Card>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Card } from '@/components/ui/card';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Auth, NavMenuItem } from '@/types';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import LoginModal from '@/pages/auth/LoginModal.vue';

const topTracks = [
    { title: 'Midnight Echoes', artist: 'Luna Rivers', plays: '1.2K', duration: '4:22' },
    { title: 'Digital Dreams', artist: 'Neon Pulse', plays: '987', duration: '3:45' },
    { title: 'Cosmic Vibes', artist: 'Star Gazer', plays: '854', duration: '5:12' },
    { title: 'Electric Nights', artist: 'Volt Storm', plays: '723', duration: '3:58' },
];
const page = usePage();
const items = computed(() => page.props.primary_menu as NavMenuItem[]);
const auth = computed(() => page.props.auth as Auth);
</script>
