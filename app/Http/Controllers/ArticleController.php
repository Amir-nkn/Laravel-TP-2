<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Appliquer l'authentification uniquement aux méthodes nécessaires
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Affiche la liste de tous les articles (accessible à tous)
     */
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Affiche le formulaire de création d'un article (pour les utilisateurs authentifiés)
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Enregistre un nouvel article dans la base de données
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'titre' => 'required|min:20|max:100',
            'contenu' => 'required|min:200',
        ], [
            'titre.required' => __('The title is required.'),
            'titre.min' => __('The title must be at least 20 characters.'),
            'titre.max' => __('The title may not be greater than 100 characters.'),
            'contenu.required' => __('The content is required.'),
            'contenu.min' => __('The content must be at least 200 characters.'),
        ]);

        // Création de l'article
        Article::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
        ]);

        // Redirection avec message de succès
        return redirect()->route('articles.index')->with('success', __('Article created successfully.'));
    }

    /**
     * Affiche un article spécifique
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Affiche le formulaire d'édition (seulement pour l'auteur)
     */
    public function edit(Article $article)
    {
        if (Auth::id() !== $article->user_id) {
            abort(403);
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Met à jour un article existant
     */
    public function update(Request $request, Article $article)
    {
        if (Auth::id() !== $article->user_id) {
            abort(403);
        }

        // Validation des données
        $request->validate([
            'titre' => 'required|min:20|max:100',
            'contenu' => 'required|min:200',
        ], [
            'titre.required' => __('The title is required.'),
            'titre.min' => __('The title must be at least 20 characters.'),
            'titre.max' => __('The title may not be greater than 100 characters.'),
            'contenu.required' => __('The content is required.'),
            'contenu.min' => __('The content must be at least 200 characters.'),
        ]);

        // Mise à jour des champs
        $article->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('articles.index')->with('success', __('Article updated successfully.'));
    }

    /**
     * Supprime un article (seulement par son auteur)
     */
    public function destroy(Article $article)
    {
        if (Auth::id() !== $article->user_id) {
            abort(403);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', __('Article deleted successfully.'));
    }
}
