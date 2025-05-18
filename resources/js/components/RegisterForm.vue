<template>
    <form class="space-y-6" @submit.prevent="handleSubmit">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <input
            v-model="name"
            id="name"
            name="name"
            type="text"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Nom"
            autocomplete="name"
          />
        </div>
        <div>
          <input
            v-model="student_id"
            id="student_id"
            name="student_id"
            type="text"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Numéro étudiant"
            autocomplete="off"
          />
        </div>
        <div>
          <input
            v-model="email"
            id="email"
            name="email"
            type="email"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Email"
            autocomplete="username"
          />
        </div>
        <div>
          <input
            v-model="password"
            id="password"
            name="password"
            type="password"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Mot de passe"
            autocomplete="new-password"
          />
        </div>
        <div>
          <input
            v-model="password_confirmation"
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Confirmer le mot de passe"
            autocomplete="new-password"
          />
        </div>
      </div>
      <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded text-sm text-center">{{ error }}</div>
      <button
        type="submit"
        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      >
        S'inscrire
      </button>
      <div class="text-sm text-center">
        <router-link to="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
          Déjà un compte ? Se connecter
        </router-link>
      </div>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const emit = defineEmits(['register'])
  
  const name = ref('')
  const student_id = ref('')
  const email = ref('')
  const password = ref('')
  const password_confirmation = ref('')
  
  const error = ref('')
  
  const handleSubmit = () => {
    error.value = ''
    if (password.value !== password_confirmation.value) {
      error.value = 'Les mots de passe ne correspondent pas.'
      return
    }
    emit('register', {
      name: name.value,
      student_id: student_id.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value
    }, setError)
  }
  
  function setError(err) {
    error.value = err
  }
  </script>
  