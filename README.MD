README – Projet Laravel TP2 : Système de gestion avancé des étudiants

Ce projet a été réalisé dans le cadre du cours 582-41B-MA – Cadriciel Web du programme AEC Conception et programmation de sites Web au Collège de Maisonneuve.
TP2 est une version améliorée de [TP1](https://github.com/Amir-nkn/Laravel-TP-1), construite entièrement à partir de zéro avec Laravel 10 pour éviter les problèmes rencontrés avec Laravel 12.
construite entièrement à partir de zéro avec Laravel 10 pour éviter les problèmes rencontrés avec Laravel 12.

🌟 Nom du projet
Maisonneuve2495450

💡 Fonctionnalités principales de TP2

- Authentification avec Laravel Breeze
- Gestion multilingue (FR / EN) avec middleware
- Système complet de gestion des étudiants et villes
- Forum (Articles + Commentaires)
- Répertoire de documents (upload + PDF)
- Validation avancée avec messages personnalisés
- Design Bootstrap 5 + Blade multilingue
- Accès restreint : seuls les utilisateurs authentifiés peuvent ajouter, modifier ou supprimer les ressources

🗃️ Configuration .env (base de données)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=maisonneuve_db
DB_USERNAME=root
DB_PASSWORD=

🚀 Étapes de création du projet
laravel new Maisonneuve2495450
cd Maisonneuve2495450
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run build
php artisan migrate
php artisan lang:publish

🌐 Multilingue (FR / EN)

- Middleware : SetLocaleMiddleware.php
- Contrôleur : SetLocaleController.php
- Routes : Route::get('/lang/{locale}', [SetLocaleController::class, 'index']);
- Fichiers : lang/fr.json et lang/en.json

📄 Modèles, Migrations, Contrôleurs
php artisan make:model Etudiant -mcr
php artisan make:model Ville -mcr
php artisan make:model Article -mcr
php artisan make:model Comment -mcr
php artisan make:model Document -mcr
php artisan make:model Forum -mcr

🌱 Seeders avec logique personnalisée (via Tinker)
php artisan make:seeder EtudiantSeeder
php artisan tinker → User::factory()->create([...]), Ville::insert([...])

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

- Seuls les utilisateurs connectés peuvent créer, modifier ou supprimer
- Auth::id() === $item->user_id pour la sécurité

💬 Commentaires

- Authentification obligatoire, validation et suppression protégée

📎 Documents

- Upload validé (PDF, ZIP, DOC, DOCX), suppression par le propriétaire
- Téléchargement disponible

🧾 PDF avec DomPDF
composer require barryvdh/laravel-dompdf
→ Utilisation de Barryvdh\DomPDF\Facade\Pdf

🧭 web.php (routes)

- Routes REST, middleware auth, changement de langue

📚 Pagination Bootstrap personnalisée
{{ $items->links('pagination::bootstrap-5') }}

📊 Tests réalisés
Connexion, CRUD étudiants/articles/forums, PDF, restrictions d'accès ✅

🗂️ Structure des dossiers

- app/Http/Controllers
- app/Models
- database/factories, migrations, seeders
- resources/views/articles, forums, documents
- lang/fr.json et en.json

## 🔧 Améliorations possibles (prochaines étapes)

- Ajout d’un système de recherche dans les listes (étudiants, forums)
- Ajout de tags ou catégories pour les articles/forums

👤 Auteur
Nom : Amirhossein Niakan
Matricule : 2495450
Projet : Maisonneuve2495450
Cours : Cadriciel Web – 582-41B-MA
Professeur : Marcos Sanches

✅ Statut du projet
✔️ Projet complété, structuré, testé, multilingue, documenté
