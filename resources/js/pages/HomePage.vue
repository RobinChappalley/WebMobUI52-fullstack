<template>
  <div>
    <Navbar />
    <section class="container mx-auto text-center pt-16">
      <h1 class="text-4xl font-bold mb-4">Bienvenue dans la Librairie</h1>
      <p class="text-gray-600 mb-6">
        Découvrez et empruntez des articles en un clic !
      </p>
      <router-link to="/articles" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Voir les articles disponibles
      </router-link>
    </section>
  </div>
</template>

<script setup>
import Navbar from '@/components/Navbar.vue'
</script>
