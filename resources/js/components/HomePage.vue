<template>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">
            Bienvenue à la Bibliothèque Audiovisuelle
        </h1>
        <p class="text-gray-600 mb-6">
            Gérez facilement vos emprunts d'articles audiovisuels.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-indigo-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-indigo-900 mb-2">
                    Articles disponibles
                </h2>
                <p class="text-indigo-700 mb-4">
                    Consultez notre catalogue d'articles audiovisuels disponibles.
                </p>
                <router-link 
                    to="/articles" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                >
                    Voir les articles
                </router-link>
            </div>
            <div class="bg-green-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-green-900 mb-2">
                    Mes emprunts
                </h2>
                <p class="text-green-700 mb-4">
                    Gérez vos emprunts en cours et consultez l'historique.
                </p>
                <router-link 
                    to="/lendings" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                >
                    Voir mes emprunts
                </router-link>
            </div>
        </div>
    </div>
</template> 