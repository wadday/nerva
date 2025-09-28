<template>
    <div class="slide-in-glass flex-1">
        <div class="flex w-full justify-center gap-x-2 h-[calc(100vh-150px)]">
            <div class="relative">
                <video src="https://cdn1.suno.ai/video_upload_833c3d91-2ce7-456e-bd2f-c99a96606ac4.mp4" preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline="" style="object-fit: cover; width: 100%; height: 100%; border-radius: 2%;" autoplay=""></video>
<!--                    <img src="/logo.png" alt="Background" class="w-full h-full object-cover" />-->
                <div class="absolute inset-x-0 rounded-md bottom-0 bg-gradient-to-t from-black/40 to-transparent pointer-events-none p-4 space-y-3">
                    <div class="flex items-center gap-3 text-white">
                        <Avatar class="w-10 h-10 border">
                            <AvatarImage src="/logo-s.png" alt="Avatar" />
                            <AvatarFallback>U</AvatarFallback>
                        </Avatar>
                        <span class="font-semibold">Leggit</span>
                        <button>Follow</button>
                    </div>
                    <p class="text-white">some descripition hasth #asdf #asdf</p>
                </div>
            </div>
            <div class="w-20 relative">
                <div class="flex h-full items-end animate-float">
                    <div class="flex flex-col gap-3">
                        <div class="text-center space-y-2 mb-2">
                            <div class="rounded-full flex items-center justify-center h-14 w-14 bg-transparent text-white border border-white/10 hover:bg-white/10 overflow-hidden">
                                <Avatar>
                                    <AvatarImage src="/logo-s.png" alt="Avatar" />
                                    <AvatarFallback>U</AvatarFallback>
                                </Avatar>
                            </div>
                        </div>
                        <div class="text-center space-y-2">
                            <button class="rounded-full flex items-center justify-center h-14 w-14 bg-transparent text-white border border-white/10 hover:bg-white/10">
                                <LucideIcon name="Heart" class="text-pink-500" />
                            </button>
                            <span class="text-sm text-white">232</span>
                        </div>
                        <div class="text-center space-y-2">
                            <button class="rounded-full flex items-center justify-center h-14 w-14 bg-transparent text-white border border-white/10 hover:bg-white/10">
                                <LucideIcon name="MessageCircle" />
                            </Button>
                            <span class="text-sm text-white">22</span>
                        </div>
                        <div class="text-center space-y-2">
                            <button class="rounded-full flex items-center justify-center h-14 w-14 bg-transparent text-white border border-white/10 hover:bg-white/10">
                                <LucideIcon name="Share2" />
                            </Button>
                            <span class="text-sm text-white">22</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute right-4 inset-y-0 flex items-center">
        <div class="absolute top-24 right-4">
            <div class="animate-float">
                <Button as-child variant="outline" class="rounded-full">
                    <Link :href="create()">
                        Create Pulse
                    </Link>
                </Button>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <Button class="rounded-full h-12 w-12 bg-transparent text-white border border-white/10 hover:bg-white/10">
                <LucideIcon name="ChevronUp" />
            </Button>
            <Button class="rounded-full h-12 w-12 bg-transparent text-white border border-white/10 hover:bg-white/10">
                <LucideIcon name="ChevronDown" />
            </Button>
        </div>
    </div>
</template>

<script setup lang="ts">
import NervaLayout from '@/layouts/app/NervaLayout.vue';
import { Button } from '@/components/ui/button';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Avatar, AvatarImage, AvatarFallback } from '@/components/ui/avatar';
import { Link } from '@inertiajs/vue3';
import { create } from '@/routes/deck/pulse';

defineOptions({
    layout: NervaLayout,
})
</script>
