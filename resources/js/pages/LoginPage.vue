<template>
  <div>
    <Navbar />
    <LoginForm :onSubmit="login" :error="error" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Navbar from '@/components/Navbar.vue'
import LoginForm from '@/components/LoginForm.vue'
import { useAuth } from '../utils/useAuth'
import axios from 'axios' // décommente quand api prête

const error = ref('')
const { login:setAuthUser } = useAuth()

const login = async (email, password) => {
  try {
    error.value = ""
    // ATTENTION: Schéma pour démo, à adapter avec ton vrai backend
    const response = await axios.post('/api/login', { email, password })
    localStorage.setItem('user', JSON.stringify(response.data))
    // Rediriger vers la page d'accueil ou autre
    router.push('/') 
    setAuthUser(response.data.user)
    // Pour test sans backend:
    // if(email === "demo@demo.fr" && password === "password") {
    //   localStorage.setItem('user', JSON.stringify({ email }))
    //   window.location = '/' // Redirige l'utilisateur
    // } else {
    //   throw new Error('Identifiants invalides')

    // }
  } catch (err) {
    error.value = err.message || 'Erreur lors de la connexion.'
  }
}
</script>
