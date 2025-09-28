<template>
    <Card class="glass-panel-lg rounded-2xl p-6 h-[500px] flex flex-col">
        <div class="flex items-center justify-between mb-0">
            <div class="flex items-center gap-3">
                <h3 class="glass-text-primary font-semibold">Live Chat</h3>
                <Badge class="bg-green-500/20 text-green-400 border-green-500/30 px-2 py-1">
                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-gentle-glow"></div>
                    Active
                </Badge>
            </div>
            <div class="glass-text-muted text-sm">
                1,247 online
            </div>
        </div>

        <ScrollArea class="flex-1 pr-4 overflow-hidden">
            <div class="space-y-3">
                <div v-for="msg in chatMessages" :key="'chat-'+msg.id" class="glass-panel rounded-lg p-3 glass-hover">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-white/10 backdrop-blur-none border border-white/20 flex items-center justify-center text-sm flex-shrink-0">
                            {{ msg.avatar }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="glass-text-primary text-sm font-medium truncate">
                                  {{msg.user}}
                                </span>
                                <span class="glass-text-muted text-xs">
                                  {{ msg.time }}
                                </span>
                            </div>


                            <div v-if="msg.type === 'gift'" class="flex items-center gap-2">
                                <LucideIcon name="Gift" class="w-4 h-4 text-yellow-400" />
                                <span class="glass-text-secondary text-sm">
                                    {{ msg.message }}
                                </span>
                                <span class="text-lg">{{ msg.gift }}</span>
                            </div>

                            <p v-else class="glass-text-secondary text-sm break-words">
                                {{ msg.message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </ScrollArea>

        <div class="pt-4 border-t border-white/10">
            <div class="flex items-center gap-2">
                <div class="relative flex-1">
                    <Input
                        value={message}

                    placeholder="Type a message..."
                    class="glass-panel border-white/10 bg-white/5 glass-text-primary placeholder:glass-text-muted pr-12 rounded-xl"
                    />
                    <Button
                        variant="ghost"
                        size="icon"
                        class="absolute right-1 top-1/2 transform -translate-y-1/2 w-8 h-8 rounded-lg hover:bg-white/10"
                    >
                        <LucideIcon name="Smile" class="w-4 h-4 glass-text-muted" />
                    </Button>
                </div>

                <Button
                    class="glass-panel border-white/10 bg-indigo-500/20 hover:bg-indigo-500/30 text-indigo-400 rounded-xl px-4"
                >
                    <LucideIcon name="Send" class="w-4 h-4" />
                </Button>
            </div>
        </div>
    </Card>
</template>

<script setup lang="ts">

import { Card } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { ScrollArea } from '@/components/ui/scroll-area';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';

const chatMessages = [
    { id: 1, user: 'SonicMaster', message: 'This track is absolutely incredible! 🎵', time: '2:34', type: 'normal', avatar: '🎵' },
    { id: 2, user: 'BeatLover', message: 'Luna Rivers never disappoints', time: '2:35', type: 'normal', avatar: '🎧' },
    { id: 3, user: 'MelodyQueen', message: 'sent a gift', time: '2:36', type: 'gift', avatar: '🎤', gift: '💎' },
    { id: 4, user: 'RhythmKing', message: 'The bass drop at 1:30 was insane!', time: '2:37', type: 'normal', avatar: '🥁' },
    { id: 5, user: 'EchoFan92', message: 'Been waiting for this premiere all week', time: '2:38', type: 'normal', avatar: '⭐' },
    { id: 6, user: 'WaveRider', message: 'This is my new favorite song', time: '2:39', type: 'normal', avatar: '🌊' },
    { id: 7, user: 'AudioPhile', message: 'The production quality is phenomenal', time: '2:40', type: 'normal', avatar: '🎚️' },
    { id: 8, user: 'SynthLover', message: 'Those synths hit different 🔥', time: '2:41', type: 'normal', avatar: '🎹' },
];
</script>
