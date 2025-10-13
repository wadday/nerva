<template>
    <div
        class="relative border-2 border-dashed rounded-lg p-6 text-center cursor-pointer transition-colors hover:border-muted-foreground/50 bg-primary/5"
        @click="!file && triggerFileDialog()"
    >
        <input
            type="file"
            :accept="accept || 'video/*,audio/*,image/*'"
            class="hidden"
            ref="fileInput"
            @change="handleUpload"
        />
        <div v-if="!file" class="flex flex-col items-center gap-4">
            <div class="relative">
                <LucideIcon name="ImagePlay" class="w-12 h-12 text-muted-foreground" />
                <LucideIcon name="ArrowUp" class="w-6 h-6 text-muted-foreground absolute -bottom-1 -right-1 bg-gray-700 rounded-full p-1" />
            </div>

            <div class="space-y-2">
                <h3 class="text-lg font-medium text-foreground">Select video to upload</h3>
            </div>
        </div>

        <div v-else class="text-left space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-foreground">{{ file.name }}</p>
                    <p class="text-sm text-muted-foreground">
                        {{ formatSize(file.size) }} • {{ uploadStatus }}
                    </p>
                </div>
                <button
                    class="text-sm px-3 py-1 bg-white/10 rounded hover:bg-white/20 transition"
                    @click.stop="replaceFile"
                >
                    Replace
                </button>
            </div>

            <div class="w-full bg-white/10 rounded h-2 overflow-hidden">
                <div
                    class="bg-blue-500 h-full transition-all"
                    :style="{ width: progress + '%' }"
                ></div>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import { ref } from 'vue'
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    endpoint: string;
    accept?: string;
    headers?: Record<string, string>;
}>()

const emit = defineEmits(['uploaded'])

const fileInput = ref<HTMLInputElement | null>(null)
const file = ref<File | null>(null)
const progress = ref(0)
const uploadStatus = ref('Uploading…')

function triggerFileDialog() {
    fileInput.value?.click()
}

function handleUpload(event: Event) {
    const selected = (event.target as HTMLInputElement).files?.[0]
    if (!selected) return

    file.value = selected
    progress.value = 0
    uploadStatus.value = 'Uploading…'

    uploadFile(selected)
}

async function uploadFile (file: File) {
    const formData = new FormData()
    formData.append('file', file)

    router.post(props.endpoint, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            ...props.headers,
        },
        onStart: () => {
            uploadStatus.value = 'Uploading...'
            progress.value = 0
        },
        onProgress: (event) => {
            if (event && event.percentage !== null) {
                progress.value = event.percentage as number
            }
        },
        onSuccess: () => {
            uploadStatus.value = 'Uploaded'
            emit('uploaded')
        },
        onError: (error) => {
            uploadStatus.value = 'Upload failed'
            console.error('Upload error:', error)
        },
    })
}

function replaceFile() {
    file.value = null
    progress.value = 0
    uploadStatus.value = ''
    if (fileInput.value) {
        fileInput.value.value = ''
    }
    triggerFileDialog()
}

function formatSize(bytes: number) {
    const kb = bytes / 1024
    return kb < 1024
        ? `${kb.toFixed(1)} KB`
        : `${(kb / 1024).toFixed(1)} MB`
}
</script>
