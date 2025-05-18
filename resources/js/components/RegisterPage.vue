<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer un compte
                </h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="register">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="name" class="sr-only">Nom</label>
                        <input
                            id="name"
                            v-model="name"
                            name="name"
                            type="text"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Nom"
                        />
                    </div>
                    <div>
                        <label for="student_id" class="sr-only">Numéro étudiant</label>
                        <input
                            id="student_id"
                            v-model="student_id"
                            name="student_id"
                            type="text"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Numéro étudiant"
                        />
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input
                            id="email"
                            v-model="email"
                            name="email"
                            type="email"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Email"
                        />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input
                            id="password"
                            v-model="password"
                            name="password"
                            type="password"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Mot de passe"
                        />
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Confirmer le mot de passe</label>
                        <input
                            id="password_confirmation"
                            v-model="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Confirmer le mot de passe"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        S'inscrire
                    </button>
                </div>

                <div class="text-sm text-center">
                    <router-link to="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Déjà un compte ? Se connecter
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            student_id: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    methods: {
        async register() {
            try {
                const formData = {
                    name: this.name,
                    student_id: this.student_id,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                };
                
                console.log('Données envoyées:', formData);
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                console.log('CSRF Token trouvé:', csrfToken);
                
                if (!csrfToken) {
                    throw new Error('Token CSRF non trouvé');
                }

                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.content
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(formData)
                });

                console.log('Statut de la réponse:', response.status);
                const data = await response.json();
                console.log('Réponse du serveur:', data);

                if (response.ok) {
                    localStorage.setItem('user', JSON.stringify(data.user));
                    this.$router.push('/');
                } else {
                    if (data.errors) {
                        const errorMessage = Object.values(data.errors).flat().join('\n');
                        alert(errorMessage);
                    } else {
                        alert(data.message || 'Erreur lors de l\'inscription');
                    }
                }
            } catch (error) {
                console.error('Erreur complète:', error);
                if (error.message === 'Token CSRF non trouvé') {
                    alert('Erreur de sécurité : Token CSRF manquant. Veuillez recharger la page.');
                } else {
                    alert('Une erreur est survenue lors de la communication avec le serveur');
                }
            }
        }
    }
}
</script>