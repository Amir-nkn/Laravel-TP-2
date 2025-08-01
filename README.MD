# README – Projet Laravel TP2 : Système de gestion avancé des étudiants

Ce projet a été réalisé dans le cadre du cours **582-41B-MA – Cadriciel Web** du programme AEC _Conception et programmation de sites Web_ au Collège de Maisonneuve.  
TP2 est une version améliorée de [TP1](https://github.com/Amir-nkn/Laravel-TP-1), construite entièrement à partir de zéro avec Laravel 10 pour éviter les problèmes rencontrés avec Laravel 12.

---

## 🌟 Nom du projet

**Maisonneuve2495450**

---

## 💡 Fonctionnalités principales de TP2

- Authentification avec Laravel Breeze
- Gestion multilingue (FR / EN) avec middleware
- Système complet de gestion des étudiants et villes
- Forum (Articles + Commentaires)
- Répertoire de documents (upload + génération PDF)
- Validation avancée avec messages personnalisés
- Design Bootstrap 5 + vues Blade multilingues
- Accès restreint : seuls les utilisateurs authentifiés peuvent ajouter, modifier ou supprimer les ressources

---

## 🗃️ Configuration `.env` (base de données)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=maisonneuve_db
DB_USERNAME=root
DB_PASSWORD=

🚀 Étapes de création du projet

composer create-project --prefer-dist laravel/laravel Maisonneuve2495450
cd Maisonneuve2495450
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run build
php artisan migrate
php artisan lang:publish

🌐 Multilingue (FR / EN)
Middleware : SetLocaleMiddleware.php

Contrôleur : SetLocaleController.php

Route :


Route::get('/lang/{locale}', [SetLocaleController::class, 'index']);

Fichiers : lang/fr.json et lang/en.json


📄 Modèles, Migrations, Contrôleurs

php artisan make:model Etudiant -mcr
php artisan make:model Ville -mcr
php artisan make:model Article -mcr
php artisan make:model Forum -mcr
php artisan make:model Comment -mcr
php artisan make:model Document -mcr
php artisan make:controller SetLocaleController
php artisan make:middleware SetLocaleMiddleware


🌱 Seeders avec logique personnalisée (via Tinker)

php artisan make:seeder EtudiantSeeder
php artisan tinker
>>> User::factory()->create([...])
>>> Ville::insert([...])
php artisan migrate:fresh --seed


🌱 Création manuelle d’utilisateurs dans Tinker :

\App\Models\User::create([
    'name' => 'Utilisateur Démo',
    'email' => 'demo@example.com',
    'password' => bcrypt('password')
]);

\App\Models\User::create([
    'name' => 'User One',
    'email' => 'user1@example.com',
    'password' => bcrypt('password')
]);

\App\Models\User::create([
    'name' => 'User Deux',
    'email' => 'user2@example.com',
    'password' => bcrypt('password')
]);



✅ Validation des formulaires

$request->validate([
    'titre' => 'required|string|min:20|max:100',
    'contenu' => 'required|string|min:200|max:1000',
], [
    'titre.required' => __('Le titre est requis.'),
    'titre.min' => __('Le titre doit contenir au moins 20 caractères.'),
    'titre.max' => __('Le titre ne peut pas dépasser 100 caractères.'),
    'contenu.required' => __('Le contenu est requis.'),
    'contenu.min' => __('Le contenu doit contenir au moins 200 caractères.'),
    'contenu.max' => __('Le contenu ne peut pas dépasser 1000 caractères.'),
]);


🧾 Forums et Articles
Seuls les utilisateurs connectés peuvent créer, modifier ou supprimer

Vérification : Auth::id() === $item->user_id


💬 Commentaires
Authentification obligatoire

Validation

Suppression protégée

📎 Documents
Upload validé : PDF, ZIP, DOC, DOCX

Suppression par le propriétaire

Téléchargement disponible


📄 PDF avec DomPDF

composer require barryvdh/laravel-dompdf


🧭 Fichier web.php
Routes REST

Middleware auth

Changement de langue via route dynamique


📚 Pagination Bootstrap personnalisée

{{ $items->links('pagination::bootstrap-5') }}


📊 Tests réalisés
Connexion

CRUD étudiants / articles / forums

Génération PDF

Restrictions d'accès
✅ Tous les tests passés


🗂️ Structure des dossiers

app/Http/Controllers
app/Models
database/factories, migrations, seeders
resources/views/articles, forums, documents
lang/fr.json et lang/en.json


🔧 Améliorations possibles (prochaines étapes)
Ajout d’un système de recherche dans les listes (étudiants, forums)

Ajout de tags ou catégories pour les articles/forums


👤 Auteur
Nom : Amirhossein Niakan

Matricule : 2495450

Projet : Maisonneuve2495450

Cours : Cadriciel Web – 582-41B-MA

Professeur : Marcos Sanches
```
