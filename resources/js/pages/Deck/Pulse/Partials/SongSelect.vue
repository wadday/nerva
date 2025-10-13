<template>
    <Dialog :open="show">
        <DialogTrigger as-child @click="open">
            <slot />
        </DialogTrigger>
        <DialogContent
            @escape-key-down="close"
            @interactOutside="close"
            class="w-[500px] overflow-hidden rounded-2xl"
        >
            <DialogHeader>
                <DialogTitle>Create Pulse</DialogTitle>
                <DialogDescription> Select Song </DialogDescription>
            </DialogHeader>
                <div class="space-y-2">
                <div class="relative">
                    <LucideIcon
                        name="Search"
                        class="text-muted-foreground absolute left-3 top-2.5 h-4 w-4"
                    />
                    <Input
                        type="text"
                        placeholder="Search by song name"
                        class="w-full pl-10"
                    />
                </div>
                <div>
                    <Tabs v-model="activeTab">
                        <TabsList
                            class="grid w-full bg-transparent shadow-none grid-cols-2"
                        >
                            <TabsTrigger
                                value="public_songs"
                                class="!dark:bg-white/60 !shadow-none rounded-none border-0 !border-b-2 !bg-transparent"
                                :class="{'!border-gray-500': activeTab === 'public_songs'}"
                            >
                                Public
                            </TabsTrigger>
                            <TabsTrigger
                                value="liked_songs"
                                class="!dark:bg-white/60 !shadow-none rounded-none border-0 !border-b-2 !bg-transparent"
                                :class="{'!border-gray-500': activeTab === 'liked_songs'}"
                            >
                                Liked
                            </TabsTrigger>
                        </TabsList>
                        <TabsContent value="public_songs">
                            <div
                                class="grid h-full max-h-[400px] gap-4 overflow-y-auto py-4"
                            >
                                <div class="flex-col gap-2">
                                    <div
                                        v-if="songs && songs.length === 0"
                                        class="text-muted text-center text-sm"
                                    >
                                        No song
                                    </div>
                                    <div
                                        v-for="song in songs"
                                        :key="'select-song-' + song.id"
                                        class="group flex cursor-pointer items-center gap-2 rounded-md p-2 hover:bg-white/10"
                                    >
                                        <div class="relative">
                                            <img
                                                :alt="song.title"
                                                :data-src="song.cover"
                                                class="ls-is-cached lazyloaded h-16 w-12 rounded-lg object-cover"
                                                :src="song.cover"
                                            />
                                            <div
                                                class="absolute inset-0 flex items-center justify-center rounded-lg"
                                            >
                                                <LucideIcon name="Play" />
                                            </div>
                                        </div>
                                        <div
                                            class="flex min-w-0 flex-1 flex-col gap-0.5"
                                        >
                                            <p
                                                class="text-md text-foreground-primary font-medium"
                                            >
                                                <a
                                                    href="/song/8c086054-e2f6-4d1b-b171-8ebbc3271048"
                                                >
                                                    {{ song.title }}
                                                </a>
                                            </p>
                                            <p
                                                class="text-foreground-primary text-sm"
                                            >
                                                {{ song.duration }}
                                            </p>
                                        </div>
                                        <div
                                            class="opacity-0 group-hover:opacity-100"
                                        >
                                            <div
                                                class="text-background-primary bg-foreground-primary relative inline-block select-none rounded-full px-6 py-2 text-center font-sans text-[15px] font-medium leading-[24px] transition duration-75 before:pointer-events-none before:absolute before:inset-0 before:rounded-[inherit] before:border before:border-transparent before:bg-transparent before:transition before:duration-75 after:pointer-events-none after:absolute after:inset-0 after:rounded-[inherit] after:bg-transparent after:opacity-0 after:transition after:duration-75 enabled:hover:after:opacity-100"
                                            >
                                                <Button
                                                    type="button"
                                                    @click="SelectSong(song)"
                                                    class="relative flex flex-row items-center justify-center gap-2"
                                                >
                                                    Use
                                                </Button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TabsContent>
                        <TabsContent value="liked_songs">
                            <div
                                class="grid h-full max-h-[400px] gap-4 overflow-y-auto py-4"
                            >
                                <div class="flex-col gap-2">
                                    <div
                                        v-if="likedSongs.length === 0"
                                        class="text-muted text-center text-sm"
                                    >
                                        No song
                                    </div>
                                    <div
                                        v-for="song in likedSongs"
                                        :key="'select-song-' + song.id"
                                        class="group flex cursor-pointer items-center gap-2 rounded-md p-2 hover:bg-white/10"
                                    >
                                        <div class="relative">
                                            <img
                                                :alt="song.title"
                                                :data-src="song.cover"
                                                class="ls-is-cached lazyloaded h-16 w-12 rounded-lg object-cover"
                                                :src="song.cover"
                                            />
                                            <div
                                                class="absolute inset-0 flex items-center justify-center rounded-lg"
                                            >
                                                <LucideIcon name="Play" />
                                            </div>
                                        </div>
                                        <div
                                            class="flex min-w-0 flex-1 flex-col gap-0.5"
                                        >
                                            <p
                                                class="text-md text-foreground-primary font-medium"
                                            >
                                                <a
                                                    href="/song/8c086054-e2f6-4d1b-b171-8ebbc3271048"
                                                >
                                                    {{ song.title }}
                                                </a>
                                            </p>
                                            <p
                                                class="text-foreground-primary text-sm"
                                            >
                                                {{ song.duration }}
                                            </p>
                                        </div>
                                        <div
                                            class="opacity-0 group-hover:opacity-100"
                                        >
                                            <div
                                                class="text-background-primary bg-foreground-primary relative inline-block select-none rounded-full px-6 py-2 text-center font-sans text-[15px] font-medium leading-[24px] transition duration-75 before:pointer-events-none before:absolute before:inset-0 before:rounded-[inherit] before:border before:border-transparent before:bg-transparent before:transition before:duration-75 after:pointer-events-none after:absolute after:inset-0 after:rounded-[inherit] after:bg-transparent after:opacity-0 after:transition after:duration-75 enabled:hover:after:opacity-100"
                                            >
                                                <Button
                                                    type="button"
                                                    @click="SelectSong(song)"
                                                    class="relative flex flex-row items-center justify-center gap-2"
                                                >
                                                    Use
                                                </Button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TabsContent>
                    </Tabs>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import SongData = App.Data.SongData;
import { computed, ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const emits = defineEmits(['selectSong']);

const page = usePage();

const show = ref(false);
const activeTab = ref('public_songs');

const songs = computed(() => page.props.public_songs as SongData[]);
const likedSongs = computed(() => page.props.liked_songs as SongData[]);

const SelectSong = (song: SongData) => {
    emits('selectSong', song);
    close()
};

const open = () => {
    show.value = true;
    fetchSongs('public_songs');
};

const fetchSongs = (tab: 'public_songs' | 'liked_songs') => {
    if (page.props[tab] !== undefined) return;

    router.reload({
        only: [tab],
    });
};

watch(() => activeTab.value, (tab) => {
    if (tab === 'public_songs' || tab === 'liked_songs') {
        fetchSongs(tab);
    }
});
const close = () => {
    show.value = false;
};
</script>
