<template>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <p class="text-gray-600 dark:text-gray-400">Last synced 1h ago</p>
            <Select>
                <SelectTrigger class="w-40">
                    <SelectValue>Last 7 days</SelectValue>
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="7days">Last 7 days</SelectItem>
                    <SelectItem value="30days">Last 30 days</SelectItem>
                    <SelectItem value="90days">Last 90 days</SelectItem>
                </SelectContent>
            </Select>
        </div>

        <h3 class="text-2xl font-semibold">Insights</h3>

        <div class="flex gap-1 glass-panel p-1 rounded-lg">
            <button
                v-for="(matric, key) in metricsData"
                class="px-4 py-2 rounded-md text-sm font-medium transition-colors hover:text-gray-900"
                :class="{'bg-white text-cyan-400 shadow-sm': key === 'pulse'}"
                :key="key"
            >
                {{ key === 'pulse' ? 'Pulse' : matric.label }}
            </button>
        </div>

        <div class="glass-panel rounded-lg p-4">
            <AreaChart
                class="h-64"
                index="name"
                :data="data"
                :categories="['total']"
                :colors="['#22d3ee', '#ec4040']"
                :show-grid-line="false"
                :show-legend="false"
                :show-x-axis="false"
                :show-y-axis="false"
                :curve-type="CurveType.Linear"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { CurveType } from "@unovis/ts"
import { AreaChart } from '@/components/ui/chart-area';

const metricsData = {
    pulse: {
        label: "Video views",
    },
    profile: {
        label: "Profile views",
    },
    likes: {
        label: "Likes",
    },
    comments: {
        label: "Comments",
    },
    shares: {
        label: "Shares",
    },
}

const data = [
    { name: "Jan", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Feb", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Mar", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Apr", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "May", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Jun", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Jul", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Aug", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Sep", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Oct", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Nov", total: Math.floor(Math.random() * 2000) + 1000 },
    { name: "Dec", total: Math.floor(Math.random() * 2000) + 1000 },
]

</script>
