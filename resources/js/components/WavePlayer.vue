<template>
    <div ref="waveformRef" id="waveform" class="relative h-14 w-full cursor-grab overflow-x-auto whitespace-nowrap active:cursor-grabbing"></div>
</template>

<script setup lang="ts">
import WaveSurfer from 'wavesurfer.js';
import RegionsPlugin from 'wavesurfer.js/dist/plugins/regions.js';
import TimelinePlugin from 'wavesurfer.js/dist/plugins/timeline.js';
import { computed, nextTick, onMounted, onUnmounted, ref, watch } from 'vue';

const props = defineProps({
    songUrl: {
        type: String,
        default: '',
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
const regionsPlugin = ref<RegionsPlugin | undefined>()
const region = ref<any>();
const sliderValue = ref(0);

const startTime = ref(0);
const endTime = computed(() => startTime.value + props.segmentLength);
const progressPercent = computed(() => (sliderValue.value / 10) * 100);
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

watch(() => props.songUrl, (url) => {
    if (!wavesurfer.value) return
    wavesurfer.value.load(url)
})

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

const regionContent = () => {

    const wrapper = document.createElement('div');
    wrapper.innerText = 'drag region to make selection';
    Object.assign(wrapper.style, {
        position: 'absolute',
        top: '4px',      // stays inside the region, never clipped
        left: '4px',
        background: 'rgba(0,0,0,0.4)',
        padding: '2px 6px',
        borderRadius: '4px',
        fontSize: '10px',
        color: '#fff',
        boxShadow: '0 0 4px rgba(0,0,0,0.2)',
        pointerEvents: 'none',
    })
    return wrapper;

}
onMounted(() => {
    regionsPlugin.value = RegionsPlugin.create();
    const regions = regionsPlugin.value;

    const ws = WaveSurfer.create({
        container: '#waveform',
        waveColor: '#888',
        progressColor: '#888',
        height: 35,
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
        ws.zoom(25)
        // Fully clear previous regions before adding a new one (prevents label stacking)
        if (regions && typeof regions.clearRegions === 'function') {
            regions.clearRegions();
        }
        if (regions && typeof regions.getRegions === 'function') {
            // Defensive: ensure DOM nodes are removed in all versions
            regions.getRegions().forEach((r) => r.remove());
        }

        const duration = ws.getDuration();
        startTime.value = Math.max(0, duration / 2 - props.segmentLength / 2);

        // Add region on the next frame to ensure previous DOM is gone before collision/label layout
        requestAnimationFrame(() => {
            region.value = regions.addRegion({
                start: startTime.value,
                end: endTime.value,
                drag: true,
                resize: false,
                content: regionContent(),
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
