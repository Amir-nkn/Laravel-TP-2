<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Applique le middleware 'auth' à toutes les actions sauf index et show
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Affiche la liste paginée des forums
     */
    public function index()
    {
        $forums = Forum::latest()->paginate(5);
        return view('forums.index', compact('forums'));
    }

    /**
     * Affiche un forum spécifique
     */
    public function show(Forum $forum)
    {
        return view('forums.show', compact('forum'));
    }

    /**
     * Affiche le formulaire de création d’un forum
     */
    public function create()
    {
        return view('forums.create');
    }

    /**
     * Enregistre un nouveau forum après validation
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|min:20|max:100',
            'contenu' => 'required|string|min:20|max:1000',
        ], [
            'titre.required' => __('The title is required.'),
            'titre.min' => __('The title must be at least 20 characters.'),
            'titre.max' => __('The title may not be greater than 100 characters.'),

            'contenu.required' => __('The content is required.'),
            'contenu.min' => __('The content must be at least 20 characters.'),
            'contenu.max' => __('The content may not be greater than 1000 characters.'),
        ]);

        Forum::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forums.index')->with('success', __('Forum post created successfully.'));
    }

    /**
     * Affiche le formulaire d’édition pour un forum (autorisé uniquement au propriétaire)
     */
    public function edit(Forum $forum)
    {
        if (Auth::id() !== $forum->user_id) {
            abort(403);
        }

        return view('forums.edit', compact('forum'));
    }

    /**
     * Met à jour un forum existant après validation
     */
    public function update(Request $request, Forum $forum)
    {
        if (Auth::id() !== $forum->user_id) {
            abort(403);
        }

        $request->validate([
            'titre' => 'required|string|min:20|max:100',
            'contenu' => 'required|string|min:20|max:1000',
        ], [
            'titre.required' => __('The title is required.'),
            'titre.min' => __('The title must be at least 20 characters.'),
            'titre.max' => __('The title may not be greater than 100 characters.'),

            'contenu.required' => __('The content is required.'),
            'contenu.min' => __('The content must be at least 20 characters.'),
            'contenu.max' => __('The content may not be greater than 1000 characters.'),
        ]);

        $forum->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('forums.index')->with('success', __('Forum post updated successfully.'));
    }

    /**
     * Supprime un forum (autorisé uniquement au propriétaire)
     */
    public function destroy(Forum $forum)
    {
        if (Auth::id() !== $forum->user_id) {
            abort(403);
        }

        $forum->delete();

        return redirect()->route('forums.index')->with('success', __('Forum post deleted successfully.'));
    }
}
