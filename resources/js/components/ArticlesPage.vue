<template>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Articles disponibles</h1>
            <div class="flex space-x-4">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Rechercher un article..."
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="article in filteredArticles" :key="article.id" class="bg-white border rounded-lg overflow-hidden shadow-sm">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ article.title }}</h3>
                    <p class="text-gray-600 mb-4">{{ article.description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            Disponible: {{ article.available ? 'Oui' : 'Non' }}
                        </span>
                        <button
                            v-if="article.available"
                            @click="borrowArticle(article.id)"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            Emprunter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            articles: [],
            search: ''
        }
    },
    computed: {
        filteredArticles() {
            return this.articles.filter(article => 
                article.title.toLowerCase().includes(this.search.toLowerCase()) ||
                article.description.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    },
    methods: {
        async fetchArticles() {
            try {
                const response = await fetch('/api/articles');
                if (response.ok) {
                    this.articles = await response.json();
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des articles:', error);
            }
        },
        async borrowArticle(articleId) {
            try {
                const response = await fetch('/api/lendings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        article_id: articleId
                    })
                });

                if (response.ok) {
                    await this.fetchArticles();
                    alert('Article emprunté avec succès');
                } else {
                    alert('Erreur lors de l\'emprunt');
                }
            } catch (error) {
                console.error('Erreur lors de l\'emprunt:', error);
                alert('Une erreur est survenue');
            }
        }
    },
    mounted() {
        this.fetchArticles();
    }
}
</script> 