<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { computed } from 'vue'

const rss = computed(() => usePage().props.value.rss)

const form = useForm({
    rss: rss.value.rss
});
function submit() {
    form.post(route('editRss', {id: rss.value.id}), {});
    
}
</script>


<template>
    <Head title="Registrar Rss" />
    <BreezeAuthenticatedLayout>
    <div class="grid grid-cols-3 gap-4">
        <div class=""></div>
        <div class="">
            <div class="grid grid-cols-3 gap-4">
                <div></div>
                <div>
                    <article class="prose prose-slate">
                        Fonte Rss
                    </article>
                </div>
                <div></div>
            </div>
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="rss" value="Link" />
                    <BreezeInput
                    id="rss"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.rss"
                    required
                    autofocus
                    :value="form.rss"
                    autocomplete="rss"
                    />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    >
                    Editar
                    </BreezeButton>
                </div>
                </form>
                <BreezeValidationErrors class="mb-4" />

        </div>
        <div class=""></div>
    </div>
    </BreezeAuthenticatedLayout>
</template>
