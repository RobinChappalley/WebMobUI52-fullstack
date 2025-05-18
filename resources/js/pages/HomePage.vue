<template>
  <div class="home">
    <h1>Bienvenue à la Bibliothèque Audiovisuelle</h1>
    <div class="features">
      <div class="feature-card">
        <h3>Articles Disponibles</h3>
        <p>Explorez notre collection de DVD, Blu-ray et autres supports audiovisuels.</p>
        <router-link to="/articles" class="btn">Voir les articles</router-link>
      </div>
      <div class="feature-card">
        <h3>Mes Emprunts</h3>
        <p>Consultez vos emprunts en cours et leur date de retour.</p>
        <router-link to="/lendings" class="btn">Voir mes emprunts</router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.home {
  text-align: center;
}

.features {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-top: 2rem;
}

.feature-card {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn {
  display: inline-block;
  background-color: #2c3e50;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  text-decoration: none;
  margin-top: 1rem;
  transition: background-color 0.3s;
}

.btn:hover {
  background-color: #34495e;
}
</style> 