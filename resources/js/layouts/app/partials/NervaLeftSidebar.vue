<template>
    <div class="w-80 space-y-6 slide-in-glass">
        <Card class="glass-panel-lg rounded-2xl rounded-lb-non p-4 glass-hover animate-float">
            <div class="flex items-center gap-3">
                <LucideIcon name="BarChart3" class="h-5 w-5 text-cyan-400" />
                <h2 class="glass-text-primary font-semibold">Live Analytics</h2>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div v-for="(stat, index) in analytics" :key="'stat-'+index" class="glass-panel rounded-xl p-4 glass-hover group">
                    <div class="flex items-center justify-between mb-2">
                        <LucideIcon :name="stat.icon" class="h-5 w-5 text-cyan-400 group-hover:text-cyan-300 transition-colors" />
                        <span class="text-xs glass-text-muted group-hover:glass-text-secondary transition-colors">
                            {{ stat.change }}
                        </span>
                    </div>
                    <div class="space-y-1">
                        <p class="text-lg font-semibold glass-text-primary">
                            {{ stat.value }}
                        </p>
                        <p class="text-xs glass-text-muted">{{ stat.label }}</p>
                    </div>
                </div>
            </div>
        </Card>

        <Card class="glass-panel-lg rounded-2xl p-4 glass-hover animate-float4">
            <div class="flex items-center gap-3 mb-0">
                <LucideIcon name="Zap" class="w-5 h-5 text-yellow-400" />
                <h2 class="glass-text-primary font-semibold">Trending Tracks</h2>
            </div>

            <div class="space-y-3">
                <div v-for="(track, i) in topTracks"
                     :key="'top-track-'+i"
                     class="glass-panel rounded-lg p-3 glass-hover group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="glass-text-primary text-sm font-medium truncate group-hover:text-indigo-300 transition-colors">
                                {{ track.title }}
                            </p>
                            <p class="glass-text-muted text-xs truncate">
                                {{ track.artist}}
                            </p>
                        </div>
                        <div class="text-right ml-3">
                            <p class="glass-text-secondary text-xs">
                                {{ track.plays }}
                            </p>
                            <p class="glass-text-muted text-xs">
                                {{ track.duration}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </Card>
    </div>
</template>

<script setup lang="ts">
import { Card } from '@/components/ui/card';
import LucideIcon from '@/components/icon/LucideIcon.vue';

const analytics = [
    { label: 'Total Listeners', value: '1,247', change: '+12%', icon: 'Users' },
    { label: 'Engagement Rate', value: '94.2%', change: '+5.7%', icon: 'Heart' },
    { label: 'Stream Quality', value: '320kbps', change: 'Optimal', icon: 'Activity' },
    { label: 'Uptime', value: '99.8%', change: '+0.2%', icon: 'Clock' },
];

const topTracks = [
    { title: 'Midnight Echoes', artist: 'Luna Rivers', plays: '1.2K', duration: '4:22' },
    { title: 'Digital Dreams', artist: 'Neon Pulse', plays: '987', duration: '3:45' },
    { title: 'Cosmic Vibes', artist: 'Star Gazer', plays: '854', duration: '5:12' },
    { title: 'Electric Nights', artist: 'Volt Storm', plays: '723', duration: '3:58' },
];
</script>
