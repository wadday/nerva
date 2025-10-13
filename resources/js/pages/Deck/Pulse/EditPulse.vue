<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <Card class="glass-panel">
                <CardHeader>
                    <CardTitle
                        class="flex items-center justify-between border-b border-white/10 pb-3"
                    >
                        <span>Edit Pulse</span>
                        <div class="flex items-center gap-2">
                            <div>
                                <UploadMedia
                                    :pulse="pulse"
                                >

                                <Button
                                    class="cursor-pointer rounded-full border border-white/10"
                                    variant="ghost"
                                >
                                    Upload Video/Image
                                </Button>
                                </UploadMedia>
                            </div>
                            <div>
                                <SongSelect @select-song="onSongSelect">
                                    <Button
                                        class="cursor-pointer rounded-full border border-white/10"
                                        variant="ghost"
                                    >
                                        <template
                                            v-if="Object.keys(form.song).length"
                                        >
                                            Replace Song
                                        </template>
                                        <template v-else>
                                            Select Song
                                        </template>
                                    </Button>
                                </SongSelect>
                            </div>
                        </div>
                    </CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="flex flex-col items-center">
                        <div
                            class="relative flex h-[calc(100svh-30rem)] min-h-40 w-full flex-row justify-center gap-4 overflow-clip px-4"
                        >
                            <div
                                class="aspect-9/16 relative h-full"
                                style="aspect-ratio: 784 / 1176"
                            >
                                <video
                                    ref="videoRef"
                                    playsinline=""
                                    class="absolute inset-0 h-full border w-full overflow-clip rounded-xl"
                                    :src="form.media[0]?.url"
                                    loop
                                ></video>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <button
                                @click="togglePlay"
                                class="rounded-full bg-black/50 p-3 text-white dark:bg-white/10"
                            >
                                <LucideIcon
                                    :name="isPlaying ? 'Pause' : 'Play'"
                                />
                            </button>
                            <div>
                                {{ formatTime(currentTime) }} /
                                {{ formatTime(pulseLength) }}
                            </div>
                        </div>
                    </div>

                    <Separator class="my-5 bg-white/10" />

                    <WavePlayer
                        v-model:currentTime="currentTime"
                        v-model:selectedTimestamp="form.selected_timestamp"
                        :is-playing="isPlaying"
                        :segmentLength="pulseLength"
                        @update:playing="togglePlay"
                        :song-url="form.song?.song_url"
                    />
                    <Separator class="my-5 bg-white/10" />
                    <div class="flex items-center justify-end gap-x-3">
                        <div>
                            <Button
                                class="cursor-pointer rounded-full border border-white/10"
                                variant="ghost"
                                >Cancel</Button
                            >
                        </div>
                        <div>
                            <PulseDetails
                                v-model:caption="form.caption"
                                v-model:status="form.status"
                                v-model:visibility="form.visibility"
                                v-model:allow_comments="form.allow_comments"
                                @submit="postPulse"
                            >
                                <Button
                                    class="cursor-pointer rounded-full border border-white/10"
                                >
                                    Next
                                </Button>
                            </PulseDetails>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import SongSelect from '@/pages/Deck/Pulse/Partials/SongSelect.vue';
import deck from '@/routes/deck';
import type { BreadcrumbItem } from '@/types';
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Separator } from '@/components/ui/separator';
import WavePlayer from '@/components/WavePlayer.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import PulseData = App.Data.PulseData;
import SongData = App.Data.SongData;
import PulseDetails from '@/pages/Deck/Pulse/Partials/PulseDetails.vue';
import UploadMedia from '@/pages/Deck/Pulse/Partials/UploadMedia.vue';
import PulseController from '@/actions/App/Http/Controllers/Deck/PulseController';

const props = withDefaults(
    defineProps<{
        pulseLength: number;
        pulse: PulseData;
    }>(),
    {
        pulseLength: 10,
    },
);

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

const videoRef = ref(null);
const isPlaying = ref(false);
const currentTime = ref(0);

const form = useForm({
    selected_timestamp: 0,
    media: props.pulse.medias || [],
    song: props.pulse.song || {},
    caption: '',
    status: 'draft',
    visibility: 'public',
    allow_comments: true,
});

const togglePlay = () => {
    if (!videoRef.value) return;

    if (videoRef.value.paused) {
        videoRef.value.play();
        isPlaying.value = true;
    } else {
        videoRef.value.pause();
        videoRef.value.currentTime = 0;
        isPlaying.value = false;
    }
};

const formatTime = (s: number) => {
    const m = Math.floor(s / 60);
    const sec = Math.floor(s % 60);
    return `${m}:${sec.toString().padStart(2, '0')}`;
};

const onSongSelect = (song: SongData) => {
    form.song = song;
    if (isPlaying.value) {
        togglePlay();
    }

    router.put(deck.pulse.update(props.pulse.uuid), {
        song_id: song.id,
    });
};

const postPulse = () => {
    form.put(PulseController.update.url(props.pulse.uuid), {
        onSuccess: () => {
            router.visit(deck.pulse.index().url)
        }
    })
}
</script>
