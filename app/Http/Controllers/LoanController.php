<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'article'])
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($loans);
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id'
        ]);

        $article = Article::findOrFail($request->article_id);

        if (!$article->is_available) {
            return response()->json([
                'message' => 'Cet article n\'est pas disponible'
            ], 400);
        }

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'article_id' => $article->id,
            'borrowed_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(14) // Prêt pour 14 jours
        ]);

        $article->update(['is_available' => false]);

        return response()->json($loan->load(['user', 'article']), 201);
    }

    public function return(Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Non autorisé'
            ], 403);
        }

        if ($loan->returned_at) {
            return response()->json([
                'message' => 'Cet article a déjà été retourné'
            ], 400);
        }

        $loan->update([
            'returned_at' => Carbon::now()
        ]);

        $loan->article->update(['is_available' => true]);

        return response()->json($loan->load(['user', 'article']));
    }
} 