<template>
    <div class="w-full px-4 py-3 text-white bg-black/50 dark:bg-white/10 space-y-4 rounded-md">
        <div class="flex flex-col flex-1 min-w-0">
            <div id="title" class="flex justify-between items-center">
                <p class="text-lg font-semibold truncate">{{ song?.title }}</p>
                <div class="text-sm text-gray-100 w-16 flex items-center justify-end whitespace-nowrap">
                    <span class="w-[35px]">{{ formattedCurrentTime }}</span> / <span class="w-[35px]">{{ formattedDuration }}</span>
                </div>
            </div>

            <div id="progress" class="w-full h-2 rounded-full overflow-hidden mt-1 bg-black/10">
                <div
                    class="h-full bg-green-400 transition-all duration-300 rounded-full"
                    :style="{width: progressBarWidth}"
                ></div>
            </div>

        </div>
        <div class="flex gap-x-1 items-center text-gray-500 dark:text-white">
            <Button size="icon">
                <ChevronLeft />
            </Button>
            <Button v-if="isPlaying" size="icon" @click="togglePlay('pause')">
                <Pause />
            </Button>
            <Button v-else size="icon" @click="togglePlay('play')">
                <Play />
            </Button>
            <Button size="icon" @click="togglePlay('stop')">
                <Square />
            </Button>
            <Button size="icon">
                <ChevronRight />
            </Button>
            <Button size="icon" @click="toggleMute">
                <VolumeX v-if="isMuted" />
                <Volume2 v-else />
            </Button>
        </div>
        <audio ref="audio"
               :src="song?.song_url"
               preload="auto"
               controls
               playsinline
               class="sr-only"
        />
    </div>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Play, Pause, Square, ChevronRight, ChevronLeft, VolumeX, Volume2 } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { useAudioController } from '@/composables/useAudioController';

defineProps<{
    song: App.Data.SongData | null;
}>();

const {
    setAudioElement,
    togglePlay,
    formattedDuration,
    formattedCurrentTime,
    progressBarWidth,
    toggleMute,
    isMuted,
    isPlaying,
} = useAudioController();

const audio = ref<HTMLAudioElement | null>(null);


onMounted(() => {
    if (audio.value) {
        setAudioElement(audio.value);
    }
})
</script>
