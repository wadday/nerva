<template>
    <Dialog :open="show">
        <DialogTrigger as-child @click="open">
            <slot />
        </DialogTrigger>
        <DialogContent class="w-[500px] overflow-hidden rounded-2xl">
            <DialogHeader>
                <DialogTitle>Upload Video/Image</DialogTitle>
                <DialogDescription />
            </DialogHeader>
            <div class="space-y-2">
                <UploadComponent
                    :endpoint="PulseMediaController.store.url(pulse)"
                    @uploaded="fileUploaded"
                />
            </div>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import UploadComponent from '@/components/UploadComponent.vue';
import PulseMediaController from '@/actions/App/Http/Controllers/Deck/PulseMediaController'
import { ref } from 'vue';

const props = defineProps<{
    pulse: App.Data.PulseData,
}>()

const show = ref<boolean>(false);

const fileUploaded = () => {
    show.value = false
}

const open = () => show.value = true
</script>
