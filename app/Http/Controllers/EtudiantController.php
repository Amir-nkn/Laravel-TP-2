<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Applique le middleware d’authentification à toutes les actions
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la liste des étudiants appartenant à l’utilisateur connecté
     */
    public function index()
    {
        $etudiants = Etudiant::where('user_id', Auth::id())
            ->with('ville')
            ->orderBy('nom')
            ->paginate(10);

        return view('etudiant.index', compact('etudiants'));
    }

    /**
     * Affiche le formulaire de création d’un nouvel étudiant
     */
    public function create()
    {
        $villes = Ville::all();
        return view('etudiant.create', compact('villes'));
    }

    /**
     * Enregistre un nouvel étudiant après validation
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom' => 'required|string|min:5|max:50',
            'adresse' => 'required|string|min:20|max:200',
            'telephone' => 'required|string|min:8|max:20',
            'email' => 'required|email|unique:etudiants,email',
            'date_naissance' => 'required|date|before:today',
            'ville_id' => 'required|exists:villes,id',
        ], [
            'nom.required' => __('The name is required.'),
            'nom.min' => __('The name must be at least 5 characters.'),
            'nom.max' => __('The name may not be greater than 50 characters.'),

            'adresse.required' => __('The address is required.'),
            'adresse.min' => __('The address must be at least 20 characters.'),
            'adresse.max' => __('The address may not be greater than 200 characters.'),

            'telephone.required' => __('The phone number is required.'),
            'telephone.min' => __('The phone number must be at least 8 digits.'),
            'telephone.max' => __('The phone number may not be greater than 20 digits.'),

            'email.required' => __('The email is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'email.unique' => __('The email has already been taken.'),

            'date_naissance.required' => __('The birthdate is required.'),
            'date_naissance.date' => __('The birthdate must be a valid date.'),
            'date_naissance.before' => __('The birthdate must be before today.'),

            'ville_id.required' => __('The city is required.'),
            'ville_id.exists' => __('The selected city is invalid.'),
        ]);

        // Création de l'étudiant
        $etudiant = new Etudiant($request->all());
        $etudiant->user_id = Auth::id();
        $etudiant->save();

        return redirect()->route('etudiant.index')->with('success', __('Student created successfully.'));
    }

    /**
     * Affiche les détails d’un étudiant spécifique
     */
    public function show($id)
    {
        $etudiant = Etudiant::with('ville')->findOrFail($id);
        $this->authorizeEtudiant($etudiant);

        return view('etudiant.show', compact('etudiant'));
    }

    /**
     * Affiche le formulaire de modification d’un étudiant
     */
    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $this->authorizeEtudiant($etudiant);
        $villes = Ville::all();

        return view('etudiant.edit', compact('etudiant', 'villes'));
    }

    /**
     * Met à jour un étudiant existant après validation
     */
    public function update(Request $request, $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $this->authorizeEtudiant($etudiant);

        // Validation des données
        $request->validate([
            'nom' => 'required|string|min:5|max:50',
            'adresse' => 'required|string|min:20|max:200',
            'telephone' => 'required|string|min:8|max:20',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'date_naissance' => 'required|date|before:today',
            'ville_id' => 'required|exists:villes,id',
        ], [
            'nom.required' => __('The name is required.'),
            'nom.min' => __('The name must be at least 5 characters.'),
            'nom.max' => __('The name may not be greater than 50 characters.'),

            'adresse.required' => __('The address is required.'),
            'adresse.min' => __('The address must be at least 20 characters.'),
            'adresse.max' => __('The address may not be greater than 200 characters.'),

            'telephone.required' => __('The phone number is required.'),
            'telephone.min' => __('The phone number must be at least 8 digits.'),
            'telephone.max' => __('The phone number may not be greater than 20 digits.'),

            'email.required' => __('The email is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'email.unique' => __('The email has already been taken.'),

            'date_naissance.required' => __('The birthdate is required.'),
            'date_naissance.date' => __('The birthdate must be a valid date.'),
            'date_naissance.before' => __('The birthdate must be before today.'),

            'ville_id.required' => __('The city is required.'),
            'ville_id.exists' => __('The selected city is invalid.'),
        ]);

        // Mise à jour
        $etudiant->update($request->all());

        return redirect()->route('etudiant.index')->with('success', __('Student updated successfully.'));
    }

    /**
     * Supprime un étudiant (si l'utilisateur est autorisé)
     */
    public function destroy(Etudiant $etudiant)
    {
        $this->authorizeEtudiant($etudiant);
        $etudiant->delete();

        return redirect()->route('etudiant.index')->with('success', __('Student deleted successfully.'));
    }

    /**
     * Vérifie que l’étudiant appartient bien à l’utilisateur connecté
     */
    private function authorizeEtudiant(Etudiant $etudiant)
    {
        if ($etudiant->user_id !== Auth::id()) {
            abort(403, __('Unauthorized access.'));
        }
    }
}
