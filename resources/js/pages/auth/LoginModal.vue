<template>
    <Dialog>
        <DialogTrigger as-child><slot /></DialogTrigger>
        <DialogContent class="sm:max-w-[450px] p-0">
            <DialogTitle />
            <DialogDescription />
            <div class="mt-12">

                <div class="w-full max-w-sm mx-auto mb-10">
                    <div class="mb-8 text-center font-bold text-3xl">Log in</div>
                    <Form
                        v-bind="AuthenticatedSessionController.store.form()"
                        :reset-on-success="['password']"
                        v-slot="{ errors, processing }"
                        class="grid grid-cols-1 gap-2">
                        <div>
                            <Label class="mb-1.5" for="login">Email or username</Label>
                            <Input id="login" class="py-5.5" type="text" name="login" placeholder="Email or username" required />
                            <InputError :message="errors.login" />
                        </div>
                        <div>
                            <Input id="password" class="py-5.5" type="password" name="password" placeholder="Password" required />
                            <InputError :message="errors.password" />
                        </div>
                        <div class="mt-1" v-if="$page.props.canResetPassword">
                            <Link :href="request()">Forgot password?</Link>
                        </div>
                        <div class="mt-5">
                            <Button type="submit" class="w-full py-5.5 bg-cyan-400" :disabled="processing">
                                <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                                Log in
                            </Button>
                        </div>
                    </Form>
                </div>
                <DialogFooter class="bg-neutral-100 dark:bg-neutral-800 rounded-b-lg">
                    <div class="w-full">
                        <div class="text-center text-gray-400 leading-normal text-sm py-4 w-full">
                            By continuing with an account located in <span class="font-bold dark:text-white">Maldives</span>, you
                            <br />agree to our <span class="font-bold dark:text-white">Terms of Service</span> and acknowledge that
                            <br />you have read our <span class="font-bold dark:text-white">Privacy Policy.</span>
                        </div>
                        <div class="w-full bg-gray-600 h-px"></div>
                        <div class="py-5 text-center text-sm">
                            Don't have an account? <Button variant="ghost" class="text-cyan-400">Sign up</Button>
                        </div>
                    </div>
                </DialogFooter>
            </div>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Form, Link } from '@inertiajs/vue3';
import { request } from '@/routes/password';
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import { LoaderCircle } from 'lucide-vue-next';

</script>
