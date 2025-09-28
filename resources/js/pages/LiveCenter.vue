
<template>
    <AppLayout>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <Card>
                <CardContent>
                    <img :src="currentSong?.cover" alt="" />
                </CardContent>
            </Card>
            <Card>
                <CardContent class="space-y-3">
                    <div class="flex gap-x-3">
                        <Select v-model="form.song">
                            <SelectTrigger>
                                <SelectValue placeholder="Select an Song" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Song</SelectLabel>
                                    <SelectItem
                                        v-for="song in songs"
                                        :key="'song-'+song.id"
                                        :value="song"
                                    >
                                        {{ song.title }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <div>
                            <Button @click="play">
                                <Play class="h-5 w-5" />
                            </Button>
                        </div>
                    </div>
                    <div>
                       <AudioPlayer :song="currentSong"/>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Card, CardContent } from '@/components/ui/card';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectGroup, SelectItem, SelectLabel } from '@/components/ui/select';
import { Button } from '@/components/ui/button'
import { Play } from 'lucide-vue-next'
import AudioPlayer from '@/components/AudioPlayer.vue';
import { useAudioController } from '@/composables/useAudioController';
import { reactive, watch } from 'vue';

defineProps<{
    songs: App.Data.SongData[];
}>();

const { loadSong, togglePlay, currentSong } = useAudioController();
const form = reactive({
    song: null
})

watch(() => form.song, (newVal) => {
    if (!newVal) return;
    loadSong(newVal)
})

const play = () => {
    togglePlay('play')
}
</script>
