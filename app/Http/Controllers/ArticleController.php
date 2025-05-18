<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Liste tous les articles
    public function index()
    {
        $articles = Article::with('currentLoan')->get();
        return response()->json($articles);
    }

    // Crée un nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:50',
            'brand'       => 'nullable|string|max:100',
            'state'       => 'required|in:disponible,emprunté',
            'description' => 'nullable|string',
        ]);

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    // Affiche un article spécifique (avec le prêt en cours)
    public function show(Article $article)
    {
        return response()->json($article->load('currentLoan'));
    }

    // Met à jour un article
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'type'        => 'sometimes|required|string|max:50',
            'brand'       => 'nullable|string|max:100',
            'state'       => 'sometimes|required|in:disponible,emprunté',
            'description' => 'nullable|string',
        ]);

        $article->update($request->all());
        return response()->json($article);
    }

    // Supprime un article
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
