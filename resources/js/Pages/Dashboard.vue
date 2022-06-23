<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head,usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import NProgress from 'nprogress'

let timeout = null

Inertia.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 250)
})

Inertia.on('progress', (event) => {
    if (NProgress.isStarted() && event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

Inertia.on('finish', (event) => {
    clearTimeout(timeout)
    if (!NProgress.isStarted()) {
        return
    } else if (event.detail.visit.completed) {
        NProgress.done()
    } else if (event.detail.visit.interrupted) {
        NProgress.set(0)
    } else if (event.detail.visit.cancelled) {
        NProgress.done()
        NProgress.remove()
    }
})
Inertia.reload({ only: ['noticias'] })
const noticias = computed(() => usePage().props.value.noticias)

</script>

<template>
    <Head title="Pagina Inicial" />

    <BreezeAuthenticatedLayout>
        <main class="py-6 px-4 sm:p-6 md:py-10 md:px-8" v-for="noticia in noticias" :key="noticia.id">
            <div class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-1">
            <div class="relative p-3 col-start-1 row-start-1 flex flex-col-reverse rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 lg:row-start-1">
                <h1 class="mt-1 text-lg font-semibold text-white sm:text-slate-900 md:text-2xl dark:sm:text-white prose prose-xl">{{noticia.title}}</h1>
                <p class="text-sm leading-4 font-medium text-white sm:text-slate-500 dark:sm:text-slate-400">{{noticia.tema}}</p>
            </div>
            <dl class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-2.5 lg:row-start-2">
                <dd class="text-indigo-600 flex items-center dark:text-indigo-400">
                </dd>
                <dd class="flex items-center">
                    {{noticia.data}}
                </dd>
            </dl>
            <div class="mt-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4">
                <button type="button" class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg">{{noticia.sentimento.sentimento}}</button>
            </div>
            <p class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 dark:text-slate-400 prose-p lg:prose-lg" v-html="noticia.content">
            </p>
            </div>
        </main>
    </BreezeAuthenticatedLayout>
</template>
