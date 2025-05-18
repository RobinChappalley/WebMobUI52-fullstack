<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('currentLoan')->get();
        return response()->json($articles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    public function show(Article $article)
    {
        return response()->json($article->load('currentLoan'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:50',
            'description' => 'nullable|string',
            'is_available' => 'sometimes|boolean'
        ]);

        $article->update($request->all());
        return response()->json($article);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
} 