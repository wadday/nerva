<template>
    <DeckLayout :breadcrumbs="breadcrumbs">
        <template #action>
            <div>
                <Button as-child variant="ghost" class="text-white">
                    <Link :href="index()">
                        <LucideIcon name="ArrowLeft" class="mr-2" />
                        Back
                    </Link>
                </Button>
            </div>
        </template>
        <div class="space-y-6 py-2">
            <UploadComponent v-model="form.file" />

            <div class="space-y-3">
                <div>Details</div>
                <Card class="flex flex-col rounded-lg p-6 !shadow-lg">
                    <div class="grid w-full gap-1.5">
                        <Label for="message">Description</Label>
                        <CaptionComponent v-model:value="form.caption" placeholder="Type your message here." />
                    </div>
                    <div class="grid w-full gap-1.5">
                        <Label for="cover">Cover</Label>
                        <UploadComponent v-model="form.cover" />
                    </div>
                </Card>
            </div>
            <div class="space-y-3">
                <div>Settings</div>
                <Card class="flex flex-col space-y-4 rounded-lg p-6 !shadow-lg">
                    <div class="grid w-64 gap-3">
                        <Label for="schedule">When to Post?</Label>
                        <RadioGroup v-model="form.publish_on" default-value="now" class="flex">
                            <div class="flex items-center space-x-2">
                                <RadioGroupItem id="r1" value="now" />
                                <Label for="r1">Now</Label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <RadioGroupItem id="r2" value="schedule" />
                                <Label for="r2">Schedule</Label>
                            </div>
                        </RadioGroup>
                        <Transition name="slide-fade">
                            <div v-if="form.publish_on === 'schedule'">
                                <VueDatePicker v-model="form.schedule_date" dark></VueDatePicker>
                            </div>
                        </Transition>
                    </div>
                    <div class="grid w-64 gap-3">
                        <Label for="view">Who can view this</Label>
                        <Select v-model="form.status" id="view">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Select an option" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="public">Public</SelectItem>
                                <SelectItem value="private">Private</SelectItem>
                                <SelectItem value="unlisted">Unlisted</SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <Checkbox v-model="form.allow_comments" class="h-5 w-5" id="allow" />
                        <Label for="allow">Allow Comment:</Label>
                    </div>
                </Card>
            </div>
            <div class="mb-3 flex items-center space-x-2">
                <Button type="button" @click="save">
                    <template v-if="form.publish_on === 'now'">
                        Post
                    </template>
                    <template v-else>
                        Schedule
                    </template>
                </Button>
                <Button variant="secondary">Save draft</Button>
                <Button variant="secondary">Discard</Button>
            </div>
        </div>
    </DeckLayout>
</template>

<script setup lang="ts">
import DeckLayout from '@/layouts/app/DeckLayout.vue';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Link, useForm } from '@inertiajs/vue3';
import { index } from '@/routes/deck/pulse';
import deck from '@/routes/deck';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import type { BreadcrumbItem } from '@/types';
import UploadComponent from '@/components/UploadComponent.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { Label } from '@/components/ui/label';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from '@/components/ui/select';
import { Checkbox } from '@/components/ui/checkbox';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import CaptionComponent from '@/components/CaptionComponent.vue';
import { watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deck',
        href: deck.index().url,
    },
    {
        title: 'Pulse',
        href: deck.pulse.index().url,
    },
    {
        title: 'Create Pulse',
        href: deck.pulse.create().url,
    },
];

const form = useForm({
    caption: '',
    file: '',
    cover: '',
    publish_on: 'now',
    schedule_date: null,
    status: 'public',
    allow_comments: true,
});

watch(() => form.publish_on, (v) => {
    if (v === 'now') {
        form.schedule_date = null
    }
})

const save = () => {
    form.post(deck.pulse.store().url);
}
</script>
