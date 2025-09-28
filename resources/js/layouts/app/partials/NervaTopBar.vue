<template>
    <header class="glass-panel border-b-0 rounded-none sticky top-0 z-40">
        <div class="max-w-[1280px] mx-auto px-8 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link href="/" class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <img src="/logo-s.png" alt="Nerva" />
                        </div>
                        <div>
                            <h1 class="glass-text-primary font-semibold">Nerva</h1>
                            <p class="glass-text-muted text-sm">Feels alive...</p>
                        </div>
                    </Link>

                    <Badge class="animate-soft-pulse bg-red-500/20 text-red-400 border-red-500/30 px-3 py-1">
                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2 animate-gentle-glow"></div>
                        LIVE
                    </Badge>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-4 glass-text-secondary text-sm">
                        <div class="flex items-center gap-2">
                            <LucideIcon name="Users" class="w-4 h-4" />
                            <span>1,247</span>
                        </div>
                        <div class="w-1 h-1 bg-white/30 rounded-full"></div>
                        <span class="glass-text-muted">Listening now</span>
                    </div>

                    <Button
                        variant="ghost"
                        size="icon"
                        class="glass-hover rounded-full w-10 h-10 glass-text-secondary hover:bg-white/10 relative"
                    >
                        <LucideIcon name="Bell" class="w-4 h-4" />
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-indigo-500 rounded-full"></div>
                    </Button>

                    <Button
                        variant="ghost"
                        size="icon"
                        class="glass-hover rounded-full w-10 h-10 glass-text-secondary hover:bg-white/10"
                    >
                        <LucideIcon name="User" class="w-4 h-4" />
                    </Button>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import LucideIcon from '@/components/icon/LucideIcon.vue';
import { Badge } from '@/components/ui/badge';
import { Link } from '@inertiajs/vue3';
</script>
