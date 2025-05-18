<template>
  <form @submit.prevent="submit" class="max-w-md mx-auto bg-white p-8 rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
    <div class="mb-4">
      <label class="block mb-1 text-gray-700" for="email">Email</label>
      <input 
        type="email" id="email" v-model="email"
        class="w-full border p-2 rounded" required autocomplete="username"
      />
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-gray-700" for="password">Mot de passe</label>
      <input
        type="password" id="password" v-model="password"
        class="w-full border p-2 rounded" required autocomplete="current-password"
      />
    </div>
    <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Se connecter</button>
    <div v-if="error" class="text-red-600 text-center mt-3">{{ error }}</div>
  </form>
</template>

<script setup>
import { ref } from 'vue'
const props = defineProps(['onSubmit', 'error'])
const email = ref('')
const password = ref('')
const submit = () => props.onSubmit(email.value, password.value)
</script>
