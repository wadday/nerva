<template>
    <div class="grid w-full grid-cols-2 gap-5 md:grid-cols-3">
        <div v-for="i in 20" class="panel-hover group space-y-3">
            <div class="relative h-48 overflow-hidden rounded-xl">
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
                <div class="absolute bottom-0 z-10 p-4">
                    <div class="flex items-center gap-1">
                        <LucideIcon name="Heart" class="text-pink-500" />
                        <span class="font-semibold text-white">232M</span>
                    </div>
                </div>
            </div>
            <div class="text-white">
                <div class="flex items-start gap-2">
                    <Avatar class="h-10 w-10 border">
                        <AvatarImage src="/logo-s.png" alt="Avatar" />
                        <AvatarFallback>U</AvatarFallback>
                    </Avatar>
                    <div class="space-y-1">
                        <div class="text-sm font-semibold">Leggit</div>
                        <p class="text-sm font-semibold">Live Headline alskdf alksdjf lkasjdf laksjdf laksdjf laksjdf alksdfj</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import LucideIcon from '@/components/icon/LucideIcon.vue';
</script>
