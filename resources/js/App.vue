<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
      <!-- ...menu inchangé... -->
     
      <!-- ... reste inchangé ... -->
    </nav>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <router-view :on-login="login" :on-logout="logout"></router-view>
    </main>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { watch } from 'vue'


export default {
  setup() {
    const isLoggedIn = ref(false)
    const router = useRouter()

    // Vérifier la présence d'un user ou token en localStorage
    const checkLoginStatus = () => {
      isLoggedIn.value = !!localStorage.getItem('user')
    }

    // Appelée lors du login réussi (ex: après succès Axios depuis Login.vue)
    const login = () => {
      isLoggedIn.value = true
      localStorage.setItem('user', 'true')
      console.log(localStorage.getItem('user'))
      
      // (Optionnel) Redirige vers home après login
      router.push('/')
    }

    // Déconnexion propre
    const logout = () => {
      localStorage.removeItem('user')
      isLoggedIn.value = false
      router.push('/login')
    }

    onMounted(() => {
      checkLoginStatus()
    })


watch(isLoggedIn, (val) => {
  console.log('isLoggedIn changed:', val)
})

    return {
      isLoggedIn, login, logout
    }
  }
}
</script>

<style>

.navbar {
  background-color: #2c3e50;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
}

.nav-brand {
  font-size: 1.5rem;
  font-weight: bold;
}

.nav-links {
  display: flex;
  gap: 1rem;
}

.nav-link {
  color: white;
  text-decoration: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.nav-link:hover {
  background-color: #34495e;
}

.container {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 0 1rem;
}
</style>