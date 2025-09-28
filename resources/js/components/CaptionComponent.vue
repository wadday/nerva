<template>
    <div :class="cn('space-y-3', className)">
        <div class="relative">
            <Textarea
                v-model="value"
                ref="textareaRef"
                :placeholder="placeholder"
                class="w-full min-h-[120px] p-3 border border-border rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
            />

            <DropdownMenu>
                <DropdownMenuTrigger
                    ref="dropdownTriggerRef"
                    class="flex gap-x-1 items-center"
                >
                    <LucideIcon name="Hash" class="w-4 h-4 text-muted-foreground" />hashtags</DropdownMenuTrigger>
                <DropdownMenuContent
                    class="w-96 max-h-64 overflow-hidden"
                    side="bottom"
                    align="start"
                >
                    <div class="p-2 border-b border-border">
                        <div class="relative">
                            <LucideIcon name="Search" class="absolute left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                            <Input
                                ref="searchInputRef"
                                placeholder="Search tags..."
                                class="pl-8 h-8 text-sm"
                                autofocus
                            />
                        </div>
                    </div>

                    <div class="max-h-48 overflow-y-auto">
                        <template v-if="filteredTags.length > 0">
                            <DropdownMenuItem
                                v-for="(tag, index) in filteredTags"
                                :key="tag.id"
                                :class="cn('flex items-center gap-2 cursor-pointer', index === suggestionIndex && 'bg-accent')"
                            >
                                <LucideIcon name="Hash" class="w-4 h-4 text-muted-foreground" />
                                <span>{{ tag.label }}</span>
                            </DropdownMenuItem>
                        </template>
                        <template v-else>
                            <DropdownMenuItem disabled class="text-muted-foreground">
                                No tags found for "{{ searchQuery }}"
                            </DropdownMenuItem>
                        </template>
                    </div>
                </DropdownMenuContent>
            </DropdownMenu>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { cn } from '@/lib/utils'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea';
import LucideIcon from '@/components/icon/LucideIcon.vue';

interface Tag {
    id: string
    label: string
    color?: string
}

const props = defineProps<{
    placeholder?: string
    onChange?: (value: string, tags: Tag[]) => void
    availableTags?: Tag[]
    className?: string
}>()
const value = defineModel<string>('value')

const DEFAULT_TAGS: Tag[] = [
    { id: '1', label: 'tutorial', color: 'bg-blue-100 text-blue-800' },
    { id: '2', label: 'review', color: 'bg-green-100 text-green-800' },
    { id: '3', label: 'gaming', color: 'bg-purple-100 text-purple-800' },
    { id: '4', label: 'music', color: 'bg-pink-100 text-pink-800' },
    { id: '5', label: 'education', color: 'bg-yellow-100 text-yellow-800' },
    { id: '6', label: 'entertainment', color: 'bg-red-100 text-red-800' },
    { id: '7', label: 'technology', color: 'bg-indigo-100 text-indigo-800' },
    { id: '8', label: 'lifestyle', color: 'bg-teal-100 text-teal-800' },
]

const searchQuery = ref('')
const selectedTags = ref<Tag[]>([])
const suggestionIndex = ref(0)

const textareaRef = ref<HTMLTextAreaElement | null>(null)
const dropdownTriggerRef = ref<HTMLButtonElement | null>(null)
const searchInputRef = ref<HTMLInputElement | null>(null)

const availableTags = computed(() => props.availableTags || DEFAULT_TAGS)

const filteredTags = computed(() =>
    availableTags.value.filter(
        (tag) =>
            tag.label.toLowerCase().includes(searchQuery.value.toLowerCase()) &&
            !selectedTags.value.some((selected) => selected.id === tag.id),
    ),
)

</script>
