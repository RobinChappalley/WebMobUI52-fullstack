<template>
  <Navbar />
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <h2 class="text-center text-3xl font-extrabold">Connexion</h2>
      <form class="mt-8 space-y-6" @submit.prevent="handleLogin">
        <div>
          <label>Email</label>
          <input
            type="email"
            v-model="form.email"
            class="mt-1 block w-full border px-3 py-2 rounded"
            required
          />
          <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email[0] }}</p>
        </div>
        <div>
          <label>Mot de passe</label>
          <input
            type="password"
            v-model="form.password"
            class="mt-1 block w-full border px-3 py-2 rounded"
            required
          />
          <p v-if="errors.password" class="text-red-500 text-sm">{{ errors.password[0] }}</p>
        </div>
        <p v-if="errors.general" class="text-red-500 text-sm text-center">{{ errors.general }}</p>
        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded font-bold">Se connecter</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import Navbar from '../components/Navbar.vue'
// Importe ton composable d'auth
import { useAuth } from '../utils/useAuth'

const router = useRouter()
const { setAuthenticatedUser } = useAuth()

const form = reactive({
  email: '',
  password: ''
})
const errors = reactive({})

async function handleLogin() {
  errors.email = null
  errors.password = null
  errors.general = null
  try {
    const response = await fetch('/api/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(form)
    })
    const data = await response.json()
    if (!response.ok) {
      if (data.errors) {
        Object.assign(errors, data.errors)
      } else {
        errors.general = data.message || 'Erreur inconnue.'
      }
      return
    }
    // Stocke le token et l'utilisateur
    localStorage.setItem('auth_token', data.token)
    setAuthenticatedUser(data.user)
    router.push('/') // Redirige vers la page d’accueil
  } catch (e) {
    errors.general = 'Impossible de se connecter. Réessayez plus tard.'
  }
}
</script>
