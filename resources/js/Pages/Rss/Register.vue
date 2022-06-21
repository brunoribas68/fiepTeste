<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";

const form = useForm({
  rss: "",
});

const submit = () => {
  form.post(route("registerRss"), {});
};
</script>


<template>
  <Head title="Registrar Rss" />
  <BreezeAuthenticatedLayout>
    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <BreezeLabel for="rss" value="Rss" />
        <BreezeInput
          id="rss"
          type="text"
          class="mt-1 block w-full"
          v-model="form.rss"
          required
          autofocus
          autocomplete="rss"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <BreezeButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </BreezeButton>
      </div>
    </form>
  </BreezeAuthenticatedLayout>
</template>
