<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Ce trait fournit toutes les méthodes nécessaires pour l'authentification
    use AuthenticatesUsers;

    /**
     * La redirection après une connexion réussie.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Constructeur du contrôleur.
     * Applique les middlewares nécessaires : invité sauf pour la déconnexion.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Valide les champs du formulaire de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'email'],
            'password' => ['required'],
        ], [
            // Messages personnalisés pour les erreurs de validation
            'email.required' => __('Ce champ est requis.'),
            'email.email' => __('Le format de l\'adresse courriel est invalide.'),
            'password.required' => __('Ce champ est requis.'),
        ]);
    }

    /**
     * Gère la réponse en cas d'échec de l'authentification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => [__('Adresse courriel non trouvée.')],
            ]);
        }

        throw ValidationException::withMessages([
            'password' => [__('Mot de passe incorrect.')],
        ]);
    }


    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Définit le champ utilisé comme identifiant de connexion.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
