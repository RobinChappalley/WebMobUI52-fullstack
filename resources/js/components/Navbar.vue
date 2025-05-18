<template>
  <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
    <div class="font-bold text-lg">
      Librairie
    </div>
    <ul class="flex space-x-6 items-center">
      <li>
        <router-link to="/" class="hover:underline">Accueil</router-link>
      </li>
      <li>
        <router-link to="/articles" class="hover:underline">Articles</router-link>
      </li>
      <li>
        <router-link to="/lendings" class="hover:underline">Emprunts</router-link>
      </li>
      <template v-if="!isAuthenticated">
        <li>
          <router-link to="/login" class="hover:underline">Connexion</router-link>
        </li>
        <li>
          <router-link to="/register" class="hover:underline">Créer un compte</router-link>
        </li>
      </template>
      <template v-else>
        <li>
          <button
            @click="handleLogout"
            class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-4 rounded transition"
          >
            Déconnexion
          </button>
        </li>
      </template>
    </ul>
  </nav>
</template>

<script setup>
import { useAuth } from '../utils/useAuth'
import { useRouter } from 'vue-router'

const { isAuthenticated, logout } = useAuth()
const router = useRouter()

function handleLogout() {
  logout()
  router.push('/login')
}
</script>
