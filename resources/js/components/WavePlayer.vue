<template>
    <input type="range" :min="0" :max="props.segmentLength" :step="0.01" v-model="sliderValue" @change="onSeek" class="mt-2 w-full" />

    <div ref="waveformRef" id="waveform" class="relative h-14 w-full cursor-grab overflow-x-auto whitespace-nowrap active:cursor-grabbing"></div>
</template>

<script setup lang="ts">
import WaveSurfer from 'wavesurfer.js';
import RegionsPlugin from 'wavesurfer.js/dist/plugins/regions.js';
import TimelinePlugin from 'wavesurfer.js/dist/plugins/timeline.js';
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

const props = defineProps({
    songUrl: {
        type: String,
        default: 'https://nerva.test/songs/mujse-juda.mp3',
    },
    segmentLength: {
        type: Number,
        default: 10, // seconds
    },
    isPlaying: Boolean,
    currentTime: Number,
    selectedTimestamp: Number,
});

const emit = defineEmits(['update:currentTime', 'update:playing', 'update:selectedTimestamp']);

const waveformRef = ref<HTMLElement>();
const wavesurfer = ref<WaveSurfer>();
const region = ref<any>();
const sliderValue = ref(0);

const startTime = ref(0);
const endTime = computed(() => startTime.value + props.segmentLength);

watch(
    () => props.isPlaying,
    (v) => {
        if (!region.value || !wavesurfer.value) return;
        if (v) {
            region.value.play(true);
        } else {
            wavesurfer.value.pause();
        }
    },
);

const updateSlider = () => {
    if (!wavesurfer.value || !region.value) return;
    const currentTime = wavesurfer.value.getCurrentTime();
    sliderValue.value = Math.max(0, Math.min(props.segmentLength, currentTime - region.value.start));
};

const onSeek = () => {
    if (!wavesurfer.value || !region.value) return;
    const seekTime = region.value.start + sliderValue.value;
    wavesurfer.value.setTime(seekTime);
};

onMounted(() => {
    const regions = RegionsPlugin.create();
    const ws = WaveSurfer.create({
        container: '#waveform',
        waveColor: '#888',
        progressColor: '#888',
        height: 25,
        barWidth: 2,
        dragToSeek: false,
        autoScroll: true,
        autoCenter: false,
        interact: false,
        fillParent: true,
        hideScrollbar: true,
        audioRate: 1,
        cursorColor: '#00d3f3',
        url: props.songUrl,
        plugins: [regions, TimelinePlugin.create()],
    });

    ws.on('decode', () => {
        ws.zoom(25);
        const duration = ws.getDuration();
        startTime.value = Math.max(0, duration / 2 - props.segmentLength / 2);

        region.value = regions.addRegion({
            start: startTime.value,
            end: endTime.value,
            drag: true,
            resize: false,
            content: 'drag to make selection',
            color: 'rgba(0,211,243,0.4)',
            minLength: props.segmentLength,
        });
        wavesurfer.value?.setTime(startTime.value);
        region.value?.on('update-end', () => {
            startTime.value = region.value.start;
            emit('update:selectedTimestamp', startTime.value);
            if (props.isPlaying) {
                ws.play(region.value.start);
            } else {
                emit('update:playing');
            }
        });
        regions.on('region-out', (r) => {
            if (props.isPlaying) {
                r.play();
            }
        });
    });

    ws.on('audioprocess', () => {
        updateSlider();
        const currentTime = ws.getCurrentTime();
        const relativeTime = currentTime - region.value.start;
        emit('update:currentTime', Math.max(0, Math.min(props.segmentLength, relativeTime)));
    });
    wavesurfer.value = ws;
});

onUnmounted(() => {
    wavesurfer.value?.destroy();
});
</script>
