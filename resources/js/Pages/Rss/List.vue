<script setup>
    import { computed } from 'vue'
    import { usePage, Head, Link } from '@inertiajs/inertia-vue3'
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import { TrashIcon, PlusCircleIcon, PencilAltIcon} from '@heroicons/vue/solid'
    const rss_list = computed(() => usePage().props.value.rss)
</script>

<template>
    <Head title="Registrar Rss" />
    <BreezeAuthenticatedLayout>
        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="py-4"></div>
            <div class="py-4">
                <Link :href="route('registerRss')" as="button" type="button">
                    <PlusCircleIcon class="h-10 w-10 text-green-500"/>
                </Link>
            </div>
            <div class="py-4"></div>
        </div>
        <div class="grid grid-cols-3 gap-0 mt-6">
            <div></div>
            <div>
                <table  table aria-describedby="Tabela para editar os Rss cadastrados" class="table-auto md:table-fixed">
                    <thead>
                        <tr>
                            <th class="border border-slate-300 prose lg:prose-xl">RSS </th>
                            <th class="border border-slate-300 prose lg:prose-xl"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="rss in rss_list" :key="rss.id">
                            <td class="border border-slate-300 prose-table">{{rss.rss}}</td>
                            <td>
                                <Link class="rounded-full" :href="route('deletarRss', {id: rss.id})" method="delete" as="button" type="button">
                                    <TrashIcon class="h-8 w-8 text-red-500"/>
                                </Link>
                                <Link class="rounded-full" :href="route('editRss', {id: rss.id})" as="button" type="button">
                                    <PencilAltIcon class="h-8 w-8 text-grey-500"/>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class=""></div>
        </div>
    </BreezeAuthenticatedLayout>
</template>


