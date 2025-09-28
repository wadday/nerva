<template>
    <div class="space-y-6">
        <h3 class="text-2xl font-semibold text-gray-900">Recent Posts</h3>

        <div class="flex gap-6">
            <div class="w-48 flex flex-col gap-1">
                <Button>
                Pulse
                </Button>
                <Button>
                Songs
                </Button>
            </div>

            <div class="flex-1 space-y-4">
                <Card key={post.id} class="p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-2xl font-bold text-gray-400">S</span>
                            </div>


                            <div>
                                <h4 class="font-semibold text-gray-900">{post.title}</h4>
                            </div>
                        </div>

                        <div class="flex items-center gap-6">

                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fillRule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                                <span class="text-sm">{post.likes}</span>
                            </div>

                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fillRule="evenodd"
                                        d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                                <span class="text-sm">{post.comments}</span>
                            </div>

                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                </svg>
                                <span class="text-sm">{post.shares}</span>
                            </div>


                            <Button variant="ghost" size="sm" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </Button>
                        </div>
                    </div>
                </Card>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { Button } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
</script>
