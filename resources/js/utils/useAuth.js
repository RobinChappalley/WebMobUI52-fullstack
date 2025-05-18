import { ref, computed } from 'vue'

const user = ref(JSON.parse(localStorage.getItem('user')))

function login(payload) {
  user.value = payload
  localStorage.setItem('user', JSON.stringify(payload))
}

function logout() {
  user.value = null
  localStorage.removeItem('user')
}

const isAuthenticated = computed(() => !!user.value)

export function useAuth() {
  return {
    user,
    isAuthenticated,
    login,
    logout,
  }
}
