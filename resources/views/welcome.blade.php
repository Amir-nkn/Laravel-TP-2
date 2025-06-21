@extends('layouts.app')

{{-- Définir le titre de la page --}}
@section('title', __('Bienvenue chez Maisonneuve Solutions'))

@section('content')
<div class="bg-light py-5">
    <div class="container">

        {{-- Section Héros principale avec texte d’introduction et boutons --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-6 text-center text-md-start">
                <h1 class="display-4 fw-bold text-primary">
                    @lang("Solutions numériques pour l'avenir")
                </h1>
                <p class="lead text-muted mt-3">
                    @lang("Nous accompagnons les établissements et les entreprises avec des outils puissants pour la gestion des étudiants, la collaboration, et la transformation digitale.")
                </p>
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fa-solid fa-rocket"></i> @lang("Commencer")
                    </a>
                    <a href="#features" class="btn btn-outline-secondary btn-lg">
                        <i class="fa-solid fa-circle-info"></i> @lang("En savoir plus")
                    </a>
                </div>
            </div>

            {{-- Animation Lottie illustrative --}}
            <div class="col-md-6 text-center">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player
                    src="https://assets1.lottiefiles.com/packages/lf20_kyu7xb1v.json"
                    background="transparent"
                    speed="1"
                    style="width: 100%; max-width: 400px; height: auto;"
                    loop
                    autoplay>
                </lottie-player>
            </div>
        </div>

        {{-- Section présentant les fonctionnalités principales --}}
        <div id="features" class="text-center py-5">
            <h2 class="fw-bold mb-4">@lang("Ce que nous offrons")</h2>
            <div class="row g-4">

                {{-- Fonctionnalité : Gestion des étudiants --}}
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded h-100">
                        <i class="fa-solid fa-user-graduate fa-2x text-primary mb-3"></i>
                        <h5>@lang("Gestion des étudiants")</h5>
                        <p class="text-muted">@lang("Suivi des profils, notes, et informations administratives.")</p>
                    </div>
                </div>

                {{-- Fonctionnalité : Publication d'articles --}}
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded h-100">
                        <i class="fa-solid fa-newspaper fa-2x text-primary mb-3"></i>
                        <h5>@lang("Publication d'articles")</h5>
                        <p class="text-muted">@lang("Créez et partagez des contenus éducatifs ou informatifs.")</p>
                    </div>
                </div>

                {{-- Fonctionnalité : Forums collaboratifs --}}
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded h-100">
                        <i class="fa-solid fa-comments fa-2x text-primary mb-3"></i>
                        <h5>@lang("Forums collaboratifs")</h5>
                        <p class="text-muted">@lang("Participez à des discussions, posez des questions, partagez des idées.")</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Appel à l'action final --}}
        <div class="text-center mt-5">
            <p class="lead">@lang("Prêt à transformer votre organisation ?")</p>
            <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                <i class="fa-solid fa-right-to-bracket"></i> @lang("Se connecter maintenant")
            </a>
        </div>
    </div>
</div>
@endsection