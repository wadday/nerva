<template>
    <div class="space-y-6">
        <div class="flex justify-between items-center gap-4">
            <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-2xl">
                <span class="text-4xl">🎵</span>
            </div>

            <div class="flex-grow space-y-3">
                <h1 class="text-2xl font-bold">Midnight Echoes</h1>
                <div class="flex items-center justify-start gap-2">
                    <Badge class="bg-red-100 text-red-700 border-red-200 flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2 animate-pulse" />
                        <span>LIVE</span>
                    </Badge>
                    <Badge class="bg-gray-100 text-gray-700 border-gray-200">
                        320kbps
                    </Badge>
                </div>

            </div>
        </div>

        <div class="space-y-2">
            <Slider
                v-model="sliderValue"
                :max="100"
                :step="1"
                class="w-full"
            />
            <div class="flex justify-between text-sm text-gray-300">
                <span>2:34</span>
                <span>4:22</span>
            </div>
        </div>

        <div class="flex items-center justify-center gap-4">
            <Button
                variant="ghost"
                size="icon"
                class="rounded-full w-12 h-12 hover:bg-gray-100"
            >
                <LucideIcon name="Heart" class="w-5 h-5" />
            </Button>

            <Button
                size="icon"
                class="rounded-full w-16 h-16 bg-cyan-600 hover:bg-cyan-700 text-white shadow-lg"
            >
                <LucideIcon name="Play" class="w-6 h-6 ml-1" />
            </Button>

            <Button
                variant="ghost"
                size="icon"
                class="rounded-full w-12 h-12 hover:bg-gray-100"
            >
                <LucideIcon name="Share2" class="w-5 h-5" />
            </Button>

        </div>

        <div class="flex items-center justify-center gap-6 pt-4 border-t border-white/10">
            <div class="text-center">
                <p class="text-lg font-semibold">1,247</p>
                <p class="text-sm text-gray-300">Listeners</p>
            </div>
            <div class="text-center">
                <p class="text-lg font-semibold">94.2%</p>
                <p class="text-sm text-gray-300">Engagement</p>
            </div>
            <div class="text-center">
                <p class="text-lg font-semibold">4.8</p>
                <p class="text-sm text-gray-300">Rating</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Slider } from '@/components/ui/slider';
import { Button } from '@/components/ui/button';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { ref } from 'vue';

const sliderValue = ref([50])
</script>
