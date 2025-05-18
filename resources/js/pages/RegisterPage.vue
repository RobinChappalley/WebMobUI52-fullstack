<template>
    <div>
      <Navbar />
      <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-md w-full space-y-8">
          <RegisterForm @register="registerUser" />
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import Navbar from '@/components/Navbar.vue'
  import { useAuth } from '../utils/useAuth'
  import RegisterForm from '@/components/RegisterForm.vue'
  import { useRouter } from 'vue-router'
  
  const router = useRouter()
  const { login:setAuthUser } = useAuth()
  async function registerUser(form, setError) {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')
      if (!csrfToken) throw new Error('Token CSRF non trouvé')
      const response = await fetch('/api/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken.content
        },
        credentials: 'same-origin',
        body: JSON.stringify(form)
      })
      const data = await response.json()
      if (response.ok) {
        localStorage.setItem('user', JSON.stringify(data.user))
        setAuthUser(data.user)
        router.push('/')
      } else {
        if (data.errors) {
          setError(Object.values(data.errors).flat().join('\n'))
        } else {
          setError(data.message || 'Erreur lors de l\'inscription')
        }
      }
    } catch (error) {
      setError(error.message.includes('CSRF') 
        ? 'Erreur de sécurité : Token CSRF manquant. Veuillez recharger la page.' 
        : 'Une erreur est survenue lors de la communication avec le serveur'
      )
    }
  }
  </script>
  