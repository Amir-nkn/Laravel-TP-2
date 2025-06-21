<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Appliquer l'authentification uniquement aux actions de création et suppression
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Enregistrer un nouveau commentaire pour un forum
     */
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $request->validate([
            'contenu' => 'required|string|min:20',
            'forum_id' => 'required|exists:forums,id',
        ], [
            'contenu.required' => __('The comment cannot be empty.'),
            'contenu.min' => __('The comment must be at least 20 characters.'),
            'forum_id.required' => __('The forum ID is required.'),
            'forum_id.exists' => __('The selected forum does not exist.'),
        ]);

        // Création du commentaire
        Comment::create([
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
            'forum_id' => $request->forum_id,
        ]);

        // Redirection avec un message de succès
        return redirect()->back()->with('success', __('Comment added!'));
    }

    /**
     * Supprimer un commentaire (seulement par son auteur)
     */
    public function destroy(Comment $comment)
    {
        // Vérification que l'utilisateur est bien le propriétaire
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        // Suppression du commentaire
        $comment->delete();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', __('Comment deleted.'));
    }
}
