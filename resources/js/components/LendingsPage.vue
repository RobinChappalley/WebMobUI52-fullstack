<template>
    <div class="lendings">
      <h2>Mes Emprunts</h2>
      <div class="lendings-list">
        <div v-for="lending in lendings" :key="lending.id" class="lending-card">
          <div class="lending-info">
            <h3>{{ lending.article.title }}</h3>
            <p class="type">{{ lending.article.type }}</p>
            <div class="dates">
              <p>Emprunté le: {{ formatDate(lending.borrowed_at) }}</p>
              <p>À rendre le: {{ formatDate(lending.due_date) }}</p>
              <p v-if="lending.returned_at">Retourné le: {{ formatDate(lending.returned_at) }}</p>
            </div>
            <div 
              v-if="!lending.returned_at" 
              class="status"
              :class="{ 'overdue': isOverdue(lending.due_date) }"
            >
              {{ isOverdue(lending.due_date) ? 'En retard' : 'En cours' }}
            </div>
          </div>
          <button 
            v-if="!lending.returned_at" 
            @click="returnArticle(lending.id)"
            class="btn"
          >
            Retourner
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  
  const lendings = ref([])
  
  const loadLendings = async () => {
    try {
      const response = await axios.get('/api/lendings')
      lendings.value = response.data
    } catch (error) {
      console.error('Erreur lors du chargement des emprunts:', error)
    }
  }
  
  const returnArticle = async (lendingId) => {
    try {
      await axios.post(`/api/lendings/${lendingId}/return`)
      await loadLendings()
    } catch (error) {
      console.error('Erreur lors du retour:', error)
    }
  }
  
  const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR')
  }
  
  const isOverdue = (dueDate) => {
    return new Date(dueDate) < new Date()
  }
  
  onMounted(loadLendings)
  </script>
  
  <style scoped>
  .lendings {
    padding: 1rem;
  }
  
  .lendings-list {
    display: grid;
    gap: 1.5rem;
    margin-top: 1.5rem;
  }
  
  .lending-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .lending-info {
    flex: 1;
  }
  
  .type {
    color: #666;
    font-size: 0.9rem;
    margin: 0.5rem 0;
  }
  
  .dates {
    margin: 1rem 0;
    color: #444;
  }
  
  .dates p {
    margin: 0.25rem 0;
  }
  
  .status {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.9rem;
    background-color: #2ecc71;
    color: white;
  }
  
  .status.overdue {
    background-color: #e74c3c;
  }
  
  .btn {
    background-color: #2c3e50;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .btn:hover {
    background-color: #34495e;
  }
  </style> 