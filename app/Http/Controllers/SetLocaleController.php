<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    /**
     * Change la langue de l'application si la langue est supportée.
     *
     * @param string $locale Le code de langue (ex: 'en' ou 'fr')
     * @return \Illuminate\Http\RedirectResponse Redirige vers la page précédente
     */
    public function index($locale)
    {
        // Vérifie si la langue demandée est supportée
        if (in_array($locale, ['en', 'fr'])) {
            // Stocke la langue sélectionnée dans la session
            session()->put('locale', $locale);
        }

        // Redirige vers la page précédente
        return redirect()->back();
    }
}
