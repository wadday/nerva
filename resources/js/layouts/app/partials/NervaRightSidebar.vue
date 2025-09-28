<template>
    <div class="w-[340px] space-y-4 slide-in-glass">
        <Card class="glass-panel-lg rounded-2xl p-4 animate-float4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <LucideIcon name="Users" class="w-5 h-5 text-cyan-400" />
                    <h3 class="glass-text-primary font-semibold">Top Listeners</h3>
                </div>
                <Badge class="bg-cyan-500/20 text-cyan-400 border-cyan-500/30">
                    Live
                </Badge>
            </div>

            <div class="space-y-3">
                <div v-for="(viewer, index) in topViewers" :key="'top-viewer-'+viewer.id" class="glass-panel rounded-xl p-3 glass-hover group">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <LucideIcon name="Crown" v-if="index === 0" class="w-6 h-6 text-yellow-400" />
                            <LucideIcon name="Star" v-if="index === 1" class="w-6 h-6 text-purple-400" />
                            <LucideIcon name="Star" v-if="index === 2" class="w-6 h-6 text-orange-400" />
                            <span class="glass-text-muted text-2xl w-8">
                              #{{ index + 1 }}
                            </span>
                        </div>

                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-none border border-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                {{ viewer.avatar }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-gray-800 animate-gentle-glow"></div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="glass-text-primary text-sm font-medium truncate group-hover:text-cyan-300 transition-colors">
                                {{ viewer.name }}
                            </p>
                            <div class="flex items-center gap-2">
                                <Badge
                                    class="text-xs px-2 py-0.5"
                                    :class="{'bg-yellow-500/20 text-yellow-400 border-yellow-500/30': viewer.tier === 'VIP', 'bg-purple-500/20 text-purple-400 border-purple-500/30': viewer.tier === 'Pro'}"
                                >
                                    {{ viewer.tier }}
                                </Badge>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Card>


        <Card class="glass-panel-lg rounded-2xl p-4 animate-float">
            <div class="flex items-center gap-3">
                <LucideIcon name="Crown" class="w-5 h-5 text-yellow-400" />
                <h3 class="glass-text-primary font-semibold">Top Supporters</h3>
                <Badge class="ml-auto bg-indigo-500/20 text-indigo-400 border-indigo-500/30">
                    Live Rank
                </Badge>
            </div>

            <div class="space-y-3">
                <div v-for="(viewer, index) in topSupporters"
                     :key="'top-rank-'+viewer.id" class="glass-panel rounded-xl p-4 glass-hover group">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                            #{{ index + 1}}
                        </div>

                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-none border border-white/20 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                            {{ viewer.avatar }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="glass-text-primary font-medium text-sm truncate group-hover:text-indigo-300 transition-colors">
                                    {{ viewer.name }}
                                </p>
                                <LucideIcon :name="viewer.badge" :class="`w-3 h-3 ${viewer.color}`" />
                            </div>
                            <div class="flex items-center gap-2">
                                <Badge class="bg-white/10 text-white/70 border-white/20 text-xs px-2 py-0.5">
                                    level
                                </Badge>
                                <span class="glass-text-muted text-xs">
                                            10 pts
                                </span>
                            </div>
                        </div>

                        <div class="w-2 h-2 bg-green-400 rounded-full animate-gentle-glow"></div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-white/10">
                <p class="glass-text-muted text-xs text-center">
                    Rankings update in real-time based on engagement
                </p>
            </div>
        </Card>
    </div>
</template>

<script setup lang="ts">
import { Card } from '@/components/ui/card';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Badge } from '@/components/ui/badge';

const topViewers = [
    { id: 1, name: 'SonicMaster', avatar: '🎵', status: 'online', tier: 'VIP' },
    { id: 2, name: 'BeatLover', avatar: '🎧', status: 'online', tier: 'Pro' },
    { id: 3, name: 'MelodyQueen', avatar: '🎤', status: 'online', tier: 'Pro' },
];

const topSupporters = [
    {
        id: 1,
        name: 'SonicMaster',
        avatar: '🎵',
        level: 'VIP',
        points: 15420,
        badge: 'Crown',
        color: 'text-yellow-400'
    },
    {
        id: 2,
        name: 'BeatLover',
        avatar: '🎧',
        level: 'Pro',
        points: 12350,
        badge: 'Star',
        color: 'text-purple-400'
    },
    {
        id: 3,
        name: 'MelodyQueen',
        avatar: '🎤',
        level: 'Pro',
        points: 9870,
        badge: 'Flame',
        color: 'text-orange-400'
    },
    {
        id: 4,
        name: 'RhythmKing',
        avatar: '🥁',
        level: 'Regular',
        points: 7560,
        badge: 'Gift',
        color: 'text-green-400'
    },
];

</script>
