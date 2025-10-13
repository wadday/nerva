<template>
        <div class="slide-in-glass flex-1">
            <div class="flex h-[calc(100vh-150px)] w-full justify-center gap-x-2">
                <Transition :name="transitionName" mode="out-in" @after-enter="onAfterEnter">
                    <div class="relative" :key="currentPulse.uuid">
                        <video
                            ref="videoRef"
                            :src="currentPulse.medias[0].url"
                            preload="auto"
                            loop
                            playsinline
                            webkit-playsinline
                            x5-playsinline
                            style="
                                object-fit: cover;
                                width: 100%;
                                height: 100%;
                                border-radius: 2%;
                                cursor: pointer;
                            "
                            autoplay
                            @click="togglePlayback"
                        ></video>
                        <audio
                            ref="audioRef"
                            :src="currentPulse.song.song_url"
                            @timeupdate="checkTime"
                            controls
                            loop
                            autoplay
                            class="hidden"
                            @play="onPlay"
                        />
                        <!--                    <img src="/logo.png" alt="Background" class="w-full h-full object-cover" />-->
                        <div
                            class="absolute inset-x-0 bottom-0 space-y-3 rounded-md bg-gradient-to-t from-black/40 to-transparent p-4"
                            @click.stop
                        >
                            <div class="flex items-center gap-3 text-white">

                                <Avatar class="h-10 w-10 border">
                                    <AvatarImage v-if="user.avatar" :src="user.avatar!" :alt="user.username" />
                                    <AvatarFallback>{{ getInitials(user.username) }}</AvatarFallback>
                                </Avatar>
                                <Link :href="ProfileController.show.url(user)" class="font-semibold">
                                    {{ user.username }}
                                </Link>
                                <button>Follow</button>
                            </div>
                            <p class="text-white">
                                {{ currentPulse.caption }}
                            </p>
                        </div>
                    </div>
                </Transition>
                <div class="relative w-20">
                    <div class="animate-float flex h-full items-end">
                        <div class="flex flex-col gap-3">
                            <div class="mb-2 space-y-2 text-center">
                                <div
                                    class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-full border border-white/10 bg-transparent text-white hover:bg-white/10"
                                >
                                    <Avatar>
                                        <AvatarImage v-if="user.avatar" :src="user.avatar!" :alt="user.username" />
                                        <AvatarFallback>
                                            {{ getInitials(user.username) }}
                                        </AvatarFallback>
                                    </Avatar>
                                </div>
                            </div>
                            <div class="space-y-2 text-center">
                                <button
                                    class="flex h-14 w-14 items-center justify-center rounded-full border border-white/10 bg-transparent text-white hover:bg-white/10"
                                >
                                    <LucideIcon
                                        name="Heart"
                                        class="text-pink-500"
                                    />
                                </button>
                                <span class="text-sm text-white">
                                    {{ currentPulse.likes_count }}
                                </span>
                            </div>
                            <div class="space-y-2 text-center">
                                <button
                                    class="flex h-14 w-14 items-center justify-center rounded-full border border-white/10 bg-transparent text-white hover:bg-white/10"
                                >
                                    <LucideIcon name="MessageCircle" />
                                </button>
                                <span class="text-sm text-white">
                                    {{ currentPulse.comments_count }}
                                </span>
                            </div>
                            <div class="space-y-2 text-center">
                                <button
                                    class="flex h-14 w-14 items-center justify-center rounded-full border border-white/10 bg-transparent text-white hover:bg-white/10"
                                >
                                    <LucideIcon name="Share2" />
                                </button>
                                <span class="text-sm text-white">
                                    {{ currentPulse.shares_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="absolute inset-y-0 right-4 flex items-center">
        <div v-if="$page.props.auth.user" class="absolute right-4 top-24">
            <div class="animate-float">
                <Button as-child variant="outline" class="rounded-full">
                    <Link :href="create()"> Create Pulse </Link>
                </Button>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <Button
                @click="lastPulse"
                :disabled="!last"
                class="h-12 w-12 rounded-full border border-white/10 bg-transparent text-white hover:bg-white/10"
            >
                <LucideIcon name="ChevronUp" />
            </Button>
            <Button
                @click="nextPulse"
                :disabled="!next"
                class="h-12 w-12 rounded-full border border-white/10 bg-transparent text-white hover:bg-white/10"
            >
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
import { Link, router } from '@inertiajs/vue3';
import { create } from '@/routes/deck/pulse';
import PulseController from '@/actions/App/Http/Controllers/PulseController';
import PulseEngagementController from '@/actions/App/Http/Controllers/Pulse/PulseEngagementController';
import ProfileController from '@/actions/App/Http/Controllers/User/ProfileController';
import { onMounted, ref, watch, computed } from 'vue';
import { getInitials } from '@/composables/useInitials';

defineOptions({
    layout: NervaLayout,
});

const props = defineProps<{
    pulse: App.Data.PulseData;
    next: App.Data.PulseData | null;
    last: App.Data.PulseData | null;
}>();

const audioRef = ref<any>(null);
const videoRef = ref<any>(null);
const currentPulse = ref(props.pulse);
const direction = ref<'up' | 'down'>('down');
const transitionName = computed(() => (direction.value === 'down' ? 'slide-down' : 'slide-up'));

const user = computed(() => currentPulse.value.user);

watch(
    () => props.pulse,
    async (newPulse: App.Data.PulseData) => {
        currentPulse.value = newPulse;
    },
);

const nextPulse = () => {
    if (props.next) {
        direction.value = 'down';
        router.visit(PulseController.url({ pulseId: props.next.uuid }), {
            preserveState: true,
        });
    }
};

const lastPulse = () => {
    if (props.last) {
        direction.value = 'up';
        router.visit(PulseController.url({ pulseId: props.last.uuid }), {
            preserveState: true,
        });
    }
};

const checkTime = () => {
    const audio = audioRef.value as HTMLAudioElement | null;
    const start = Number(currentPulse.value.selected_timestamp || 0);
    const end = start + 10;

    if (audio && audio.currentTime > end) {
        audio.currentTime = start;
        audio.play();
    }
};

const isPlaying = () => {
    const audio = audioRef.value as HTMLAudioElement | null;
    const video = videoRef.value as HTMLVideoElement | null;
    // If any of them is playing, consider as playing
    return (!!audio && !audio.paused) || (!!video && !video.paused);
};

const togglePlayback = () => {
    const audio = audioRef.value as HTMLAudioElement | null;
    const video = videoRef.value as HTMLVideoElement | null;

    if (isPlaying()) {
        audio?.pause();
        video?.pause();
    } else {
        // Try to play both; ignore autoplay restrictions errors
        audio?.play?.().catch(() => {});
        video?.play?.().catch(() => {});
    }
};

const onAfterEnter = () => {
    const audio = audioRef.value as HTMLAudioElement | null;
    const video = videoRef.value as HTMLVideoElement | null;
    const start = Number(currentPulse.value.selected_timestamp || 0);

    if (audio) {
        try {
            if (audio.readyState < 1) {
                const onMeta = () => {
                    audio.currentTime = start;
                    audio.play().catch(() => {});
                    audio.removeEventListener('loadedmetadata', onMeta);
                };
                audio.addEventListener('loadedmetadata', onMeta);
                audio.load();
            } else {
                audio.currentTime = start;
                audio.play().catch(() => {});
            }
        } catch (_) {}
    }

    if (video) {
        video.play().catch(() => {});
    }
};
const init = () => {
    const audio = audioRef.value as HTMLAudioElement | null;
    const video = videoRef.value as HTMLVideoElement | null;
    if (audio) {
        audio.currentTime = Number(currentPulse.value.selected_timestamp || 0);
        audio.play();
    }
    // if (video) {
    //     video.play().catch(() => {});
    // }
}

const onPlay = () => {
    router.put(PulseEngagementController.play.url(currentPulse.value.uuid))
}

onMounted(() => {
    init()
});
</script>

<style scoped>
.slide-down-enter-active,
.slide-down-leave-active,
.slide-up-enter-active,
.slide-up-leave-active {
  transition: transform 250ms ease, opacity 250ms ease;
}

/* Next (down) → new content slides up into view while old slides down */
.slide-down-enter-from {
  transform: translateY(-24px);
  opacity: 0;
}
.slide-down-enter-to {
  transform: translateY(0);
  opacity: 1;
}
.slide-down-leave-from {
  transform: translateY(0);
  opacity: 1;
}
.slide-down-leave-to {
  transform: translateY(24px);
  opacity: 0;
}

/* Prev (up) → new content slides down into view while old slides up */
.slide-up-enter-from {
  transform: translateY(24px);
  opacity: 0;
}
.slide-up-enter-to {
  transform: translateY(0);
  opacity: 1;
}
.slide-up-leave-from {
  transform: translateY(0);
  opacity: 1;
}
.slide-up-leave-to {
  transform: translateY(-24px);
  opacity: 0;
}
</style>
