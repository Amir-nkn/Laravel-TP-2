<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;

// Rediriger la page d'accueil vers la liste des étudiants si connecté, sinon vers la page de bienvenue
Route::get('/', function () {
  return auth()->check()
    ? redirect()->route('home')
    : view('welcome');
});

// Changer la langue de l'interface
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang.switch');

// Routes pour la gestion des étudiants
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');
Route::get('/create/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('/create/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::get('/edit/etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::put('/edit/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');

// Authentification Laravel (login, register, etc.)
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes pour les articles (édition et création nécessitent l'authentification)
Route::resource('articles', ArticleController::class)->except(['index', 'show']);
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Routes protégées par authentification pour les documents
Route::middleware(['auth'])->group(function () {
  Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
  Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
  Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
  Route::get('/documents/{document}/pdf', [DocumentController::class, 'downloadPDF'])->name('documents.pdf');
});

// Liste publique des documents
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

// Affichage des détails d'un document
Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');

// Routes pour la ressource Forum (CRUD complet)
Route::resource('forums', ForumController::class);

// Gestion des commentaires
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Enregistrement des commentaires, nécessite une authentification
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
