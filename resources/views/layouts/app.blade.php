<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-100">

<head>
    {{-- Définition du jeu de caractères et mise en page responsive --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Titre dynamique basé sur le nom de l'application et le titre de chaque page --}}
    <title>{{ config('app.name', 'Maisonneuve') }} - @yield('title', 'Accueil')</title>

    {{-- Inclusion de Bootstrap pour la mise en page --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Police Google personnalisée --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    {{-- Bibliothèque d'icônes Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Favicon du site --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Feuille de styles personnalisée incluse directement ici --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #343a40;
        }

        header {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .navbar {
            background: linear-gradient(90deg, #007bff, #00c6ff);
        }

        .navbar .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.2s;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 5px;
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #ffffff !important;
        }

        .dropdown-menu a.active {
            font-weight: bold;
            color: #0d6efd !important;
        }

        footer {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: #ffffff;
        }

        .btn {
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
        }

        .btn-gradient {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: white;
            border: none;
        }

        .btn-gradient:hover {
            background: linear-gradient(to right, #5a67d8, #6b46c1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Barre de navigation principale --}}
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                {{-- Logo et nom du site --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name') }}
                </a>

                {{-- Bouton menu mobile --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    {{-- Menu gauche --}}
                    <ul class="navbar-nav me-auto">
                        {{-- Lien vers les étudiants --}}
                        <li class="nav-item">
                            <a class="nav-link text-uppercase px-3 {{ request()->routeIs('etudiant.*') ? 'active' : '' }}" href="{{ route('etudiant.index') }}">
                                @lang('Students')
                            </a>
                        </li>

                        {{-- Menu déroulant pour les ressources --}}
                        @php
                        $isActive = request()->is('articles*') || request()->is('documents*') || request()->is('forums*');
                        @endphp

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase px-3 {{ $isActive ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                                📚 @lang('Resources')
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">
                                        📝 @lang('Articles')
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('documents.*') ? 'active' : '' }}" href="{{ route('documents.index') }}">
                                        📁 @lang('Documents')
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('forums.*') ? 'active' : '' }}" href="{{ route('forums.index') }}">
                                        💬 @lang('Forums')
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    {{-- Menu droit --}}
                    <ul class="navbar-nav ms-auto">
                        {{-- Sélecteur de langue --}}
                        <li class="nav-item dropdown">
                            @php $locale = session('locale', app()->getLocale()); @endphp
                            <a class="nav-link dropdown-toggle text-uppercase px-3" href="#" data-bs-toggle="dropdown">
                                🌐 @lang('Language') ({{ strtoupper($locale) }})
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">🇫🇷 @lang('French')</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">🇬🇧 @lang('English')</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Liens d'authentification --}}
                        @guest
                        <li class="nav-item">
                            <a class="nav-link text-uppercase px-3" href="{{ route('login') }}">@lang('Login')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase px-3" href="{{ route('register') }}">@lang('Register')</a>
                        </li>
                        @else
                        {{-- Nom de l’utilisateur connecté --}}
                        <li class="nav-item">
                            <span class="nav-link text-uppercase px-3">{{ Auth::user()->name }}</span>
                        </li>
                        {{-- Bouton de déconnexion sécurisé --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-uppercase px-3 text-white" style="text-decoration: none;">
                                    @lang('Logout')
                                </button>
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- Contenu principal de la page --}}
    <main class="container flex-grow-1 py-4">

        {{-- Affichage des messages de succès en session --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Insertion du contenu spécifique à chaque vue --}}
        @yield('content')
    </main>

    {{-- Pied de page --}}
    <footer class="py-3 mt-auto">
        <div class="text-center">
            &copy; {{ date('Y') }} {{ config('app.name') }} – @lang('All rights reserved.')
        </div>
    </footer>

    {{-- Chargement du JavaScript de Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Insertion de scripts spécifiques à chaque page --}}
    @yield('scripts')

</body>

</html>