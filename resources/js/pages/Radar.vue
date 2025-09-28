<template>
    <div class="slide-in-glass grid w-full grid-cols-2 gap-5 md:grid-cols-4">
        <div v-for="i in 20" class="space-y-2">
            <div class="relative overflow-hidden rounded-xl">
                <video
                    src="https://cdn1.suno.ai/video_upload_833c3d91-2ce7-456e-bd2f-c99a96606ac4.mp4"
                    preload="auto"
                    loop=""
                    playsinline=""
                    webkit-playsinline=""
                    x5-playsinline=""
                    style="object-fit: cover; width: 100%; height: 100%; border-radius: 2%"
                    autoplay=""
                ></video>
                <div class="absolute z-10 bottom-0 p-4">
                    <div class="flex items-center gap-1">
                        <LucideIcon name="Heart" class="text-pink-500" />
                        <span class="font-semibold text-white">232M</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <Avatar class="h-8 w-8">
                    <AvatarImage src="/logo-s.png" alt="Avatar" />
                    <AvatarFallback>U</AvatarFallback>
                </Avatar>
                <span class="font-semibold text-white">Leggit</span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import NervaLayout from '@/layouts/app/NervaLayout.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import LucideIcon from '@/components/icon/LucideIcon.vue';

defineOptions({
    layout: NervaLayout,
})
</script>
