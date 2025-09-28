<template>
    <div class="flex-1 flex flex-col gap-4 slide-in-glass">
        <div class="glass-panel-lg rounded-3xl p-8 animate-float">
            <NowPlayingBar />
<!--            <WaveformVisualizer />-->
        </div>

        <LiveChatPanel />
    </div>
</template>

<script setup lang="ts">
import NowPlayingBar from './NowPlayingBar.vue';
import WaveformVisualizer from './WaveformVisualizer.vue';
import LiveChatPanel from './LiveChatPanel.vue';
</script>
