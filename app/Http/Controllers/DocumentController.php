<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Appliquer l'authentification à toutes les méthodes du contrôleur
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la liste paginée des documents
     */
    public function index()
    {
        $documents = Document::latest()->paginate(5);
        return view('documents.index', compact('documents'));
    }

    /**
     * Affiche le formulaire d'ajout de document
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Enregistre un nouveau document après validation
     */
    public function store(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'titre' => 'required|string|max:255',
            'fichier' => 'required|file|mimes:pdf,zip,doc,docx|max:5120',
        ], [
            'titre.required' => __('The title is required.'),
            'titre.max' => __('The title may not be greater than 255 characters.'),

            'fichier.required' => __('You must upload a file.'),
            'fichier.file' => __('The uploaded file must be valid.'),
            'fichier.mimes' => __('The file must be a PDF, ZIP, DOC or DOCX.'),
            'fichier.max' => __('The file may not be greater than 5MB.'),
        ]);

        // Enregistrement du fichier dans le stockage public
        $path = $request->file('fichier')->store('documents', 'public');

        // Création du document dans la base de données
        Document::create([
            'titre' => $request->titre,
            'fichier' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('documents.index')->with('success', __('File uploaded successfully.'));
    }

    /**
     * Supprime un document (si l'utilisateur est le propriétaire)
     */
    public function destroy(Document $document)
    {
        // Vérification des droits d'accès
        if (Auth::id() !== $document->user_id) {
            abort(403);
        }

        // Suppression du fichier physique
        Storage::disk('public')->delete($document->fichier);

        // Suppression de l'enregistrement en base
        $document->delete();

        return redirect()->route('documents.index')->with('success', __('File deleted successfully.'));
    }

    /**
     * Affiche les détails d’un document
     */
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }
}
