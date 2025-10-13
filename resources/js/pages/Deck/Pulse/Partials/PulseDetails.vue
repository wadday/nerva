<template>
    <Dialog>
        <DialogTrigger as-child>
            <slot />
        </DialogTrigger>
        <DialogContent
            class="w-[500px] overflow-hidden rounded-2xl"
        >
            <DialogHeader>
                <DialogTitle>Pulse Details</DialogTitle>
                <DialogDescription />
            </DialogHeader>
            <div class="space-y-4">
                <div>
                    <Textarea
                        placeholder="Add a caption..."
                        v-model="caption"
                    />
                </div>
                <div class="flex items-center justify-between">
                    <Label for="allow-comment">Allow comments</Label>
                    <Switch v-model="allowComment" id="allow-comment" />
                </div>
                <div class="space-y-1">
                    <Label for="status">Status</Label>
                    <Select
                        v-model="status"
                    >
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Select a status" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="draft"> Draft </SelectItem>
                            <SelectItem value="published">
                                Published
                            </SelectItem>
                        </SelectContent>
                    </Select>
                </div>
                <div class="space-y-1">
                    <Label for="status">Visibility</Label>
                    <Select
                        v-model="visibility"
                    >
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Select a Visibility" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="public"> Public </SelectItem>
                            <SelectItem value="private"> Private </SelectItem>
                            <SelectItem value="friends-only">
                                Friends Only
                            </SelectItem>
                        </SelectContent>
                    </Select>
                </div>
            </div>
            <DialogFooter>
                <Button @click="emit('submit')" type="button">Post</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Textarea } from '@/components/ui/textarea';
import { Label } from '@/components/ui/label';
import { Switch } from '@/components/ui/switch';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Button } from '@/components/ui/button';

const emit = defineEmits<{
    (e: 'update:caption', value: string): void;
    (e: 'update:status', value: string): void;
    (e: 'update:visibility', value: string): void;
    (e: 'update:allow_comment', value: boolean): void;
    (e: 'submit'): void
}>();

const allowComment = defineModel<boolean>('allow_comments')
const visibility = defineModel<string>('visibility')
const status = defineModel<string>('status')
const caption = defineModel<string>('caption')

</script>
