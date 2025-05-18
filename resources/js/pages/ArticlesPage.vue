<template>
  <div class="articles">
    <h2>Articles Disponibles</h2>
    <div class="articles-grid">
      <div v-for="article in articles" :key="article.id" class="article-card">
        <h3>{{ article.title }}</h3>
        <p class="type">{{ article.type }}</p>
        <p class="description">{{ article.description }}</p>
        <div class="status" :class="{ 'available': article.is_available }">
          {{ article.is_available ? 'Disponible' : 'Emprunté' }}
        </div>
        <button 
          v-if="article.is_available" 
          @click="borrowArticle(article.id)"
          class="btn"
        >
          Emprunter
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const articles = ref([])

const loadArticles = async () => {
  try {
    const response = await axios.get('/api/articles')
    articles.value = response.data
  } catch (error) {
    console.error('Erreur lors du chargement des articles:', error)
  }
}

const borrowArticle = async (articleId) => {
  try {
    await axios.post('/api/lendings', { article_id: articleId })
    await loadArticles()
  } catch (error) {
    console.error('Erreur lors de l\'emprunt:', error)
  }
}

onMounted(loadArticles)
</script>

<style scoped>
.articles {
  padding: 1rem;
}

.articles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-top: 1.5rem;
}

.article-card {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.type {
  color: #666;
  font-size: 0.9rem;
  margin: 0.5rem 0;
}

.description {
  margin: 1rem 0;
  color: #444;
}

.status {
  display: inline-block;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.9rem;
  margin-bottom: 1rem;
  background-color: #e74c3c;
  color: white;
}

.status.available {
  background-color: #2ecc71;
}

.btn {
  width: 100%;
  background-color: #2c3e50;
  color: white;
  padding: 0.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn:hover {
  background-color: #34495e;
}
</style> 