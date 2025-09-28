<template>
    <component
        :is="iconName[name]"
        :class="cn('h-6 w-6', props.class)"
        :ariaHidden="true"
    />
</template>

<script setup>
import * as iconName from 'lucide-vue-next';
import { cn } from '@/lib/utils.js';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    class: null,
});
</script>
