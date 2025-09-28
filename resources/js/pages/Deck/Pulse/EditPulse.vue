<template>
    <DeckLayout :breadcrumbs="breadcrumbs">
        <Card class="glass-panel">
            <CardHeader>
                <CardTitle class="flex items-center justify-between border-b border-white/10 pb-3">
                    <span>Edit Pulse</span>
                    <div class="flex items-center gap-2">
                        <div>
                            <Button class="cursor-pointer rounded-full border border-white/10" variant="ghost">Replace Video/Image</Button>
                        </div>
                        <div>
                            <SongSelect>
                                <Button class="cursor-pointer rounded-full border border-white/10" variant="ghost">Replace Song</Button>
                            </SongSelect>
                        </div>
                    </div>
                </CardTitle>
            </CardHeader>
            <CardContent>

                <div class="flex items-center flex-col">
                    <div class="relative flex h-[calc(100svh-30rem)] min-h-40 w-full flex-row justify-center gap-4 overflow-clip px-4">
                        <div class="aspect-9/16 relative h-full" style="aspect-ratio: 784 / 1176">
                            <video
                                ref="videoRef"
                                playsinline=""
                                class="absolute inset-0 h-full w-full overflow-clip rounded-xl"
                                src="https://cdn1.suno.ai/video_upload_833c3d91-2ce7-456e-bd2f-c99a96606ac4.mp4"
                                loop
                            ></video>
                        </div>
                    </div>
                    <div class="mt-3 flex gap-2 items-center">
                        <button @click="togglePlay" class="bg-white/10 p-3 rounded-full text-white">
                            <LucideIcon :name="isPlaying ? 'Pause' : 'Play'" />
                        </button>
                        <div>
                            {{ formatTime(currentTime) }} / {{ formatTime(pulseLength) }}
                        </div>
                    </div>
                </div>

                <Separator class="bg-white/10 my-5" />

                <WavePlayer
                    v-model:currentTime="currentTime"
                    v-model:selectedTimestamp="form.selected_timestamp"
                    :is-playing="isPlaying"
                    :segmentLength="pulseLength"
                    @update:playing="togglePlay"
                />
                <Separator class="bg-white/10 my-5" />
                <div class="flex justify-end items-center gap-x-3">
                    <div>
                        <Button class="cursor-pointer rounded-full border border-white/10" variant="ghost">Cancel</Button>
                    </div>
                    <div>
                        <Button class="cursor-pointer rounded-full border border-white/10">Next</Button>
                    </div>
                </div>
            </CardContent>
        </Card>
    </DeckLayout>
</template>
<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import DeckLayout from '@/layouts/app/DeckLayout.vue';
import SongSelect from '@/pages/Deck/Pulse/Partials/SongSelect.vue';
import deck from '@/routes/deck';
import type { BreadcrumbItem } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Separator } from '@/components/ui/separator';
import WavePlayer from '@/components/WavePlayer.vue';

withDefaults(defineProps<{pulseLength: number}>(), {
    pulseLength: 10,
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deck',
        href: deck.index().url,
    },
    {
        title: 'Pulse',
        href: deck.pulse.index().url,
    },
    {
        title: 'Create Pulse',
        href: deck.pulse.create().url,
    },
];

const videoRef = ref(null)
const isPlaying = ref(false)
const currentTime = ref(0)

const form = useForm({
    song_id: null,
    selected_timestamp: 0,
});

const togglePlay = () => {
    if (!videoRef.value) return

    if (videoRef.value.paused) {
        videoRef.value.play()
        isPlaying.value = true
    } else {
        videoRef.value.pause()
        videoRef.value.currentTime = 0
        isPlaying.value = false
    }
}

const formatTime = (s: number) => {
    const m = Math.floor(s / 60)
    const sec = Math.floor(s % 60)
    return `${m}:${sec.toString().padStart(2, '0')}`
}
</script>
