<template>
  <div>
    <h1>Articles disponibles à l’emprunt</h1>

    <div v-if="loading">Chargement en cours…</div>
    <div v-else>
      <div v-if="error" class="error">{{ error }}</div>
      <ul v-if="articles.length">
        <li v-for="article in articles" :key="article.id">
          <strong>{{ article.title }}</strong><br>
          {{ article.description }}
        </li>
      </ul>
      <div v-else>
        Aucun article disponible.
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { apiListArticles } from '@/utils/articleApi';
import Navbar from '@/components/Navbar.vue';

const articles = ref([]);
const loading = ref(true);
const error = ref('');

onMounted(() => {
  apiListArticles()
    .then(data => {
      // Adapter selon le format de ta réponse API
      articles.value = data.data || data; // data.data pour un Laravel API Resource
    })
    .catch(e => {
      error.value = e?.data?.message || e?.statusText || 'Erreur lors du chargement !';
    })
    .finally(() => loading.value = false);
});
</script>

<style scoped>
.error {
  color: red;
}
</style>
