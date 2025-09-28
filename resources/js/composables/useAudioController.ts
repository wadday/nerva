import { ref, computed } from 'vue'

const audio = ref<HTMLAudioElement | null>(null)
const currentSong = ref<App.Data.SongData | null>(null)
const isPlaying = ref(false)
const currentTime = ref(0)
const duration = ref(0)
const isMuted = ref(false)

const toggleMute = () => {
    if (!audio.value) return

    isMuted.value = !isMuted.value
    audio.value.muted = isMuted.value
}

const formattedTime = (s: number) => `${Math.floor(s / 60)}:${Math.floor(s % 60).toString().padStart(2, '0')}`

const loadSong = (song: App.Data.SongData) => {
    currentSong.value = song
    if (audio.value) {
        audio.value.src = song.song_url
        audio.value.load()
    }
}

const togglePlay = (action: 'play' | 'stop' | 'pause' = 'play') => {
    if (!audio.value) return
    switch (action) {
        case 'play':
            audio.value.play()
            isPlaying.value = true
            break;
        case 'stop':
            audio.value.pause()
            audio.value.currentTime = 0
            isPlaying.value = false
            break;
        case 'pause':
            audio.value.pause()
            isPlaying.value = false
            break;
    }
}

const setAudioElement = (el: HTMLAudioElement) => {
    audio.value = el
    el.addEventListener('timeupdate', () => {
        currentTime.value = el.currentTime
    })

    el.addEventListener('loadedmetadata', () => {
        duration.value = el.duration
    })

    el.addEventListener('ended', () => {
        currentTime.value = 0
        isPlaying.value = false
    })
}

export const useAudioController = () => ({
    toggleMute,
    formattedTime,
    loadSong,
    togglePlay,
    setAudioElement,
    formattedCurrentTime: computed(() => formattedTime(currentTime.value)),
    formattedDuration: computed(() => formattedTime(duration.value)),
    progressBarWidth: computed(() => duration.value ? `${(currentTime.value / duration.value) * 100}%` : '0%'),
    isPlaying,
    isMuted,
    currentSong,
})
