@extends('layouts.app')
@section('title', __('Article Details'))

@section('content')
<div class="container mt-4">
    <!-- Titre de l’article -->
    <h1 class="mb-4 text-primary">
        <i class="fa-solid fa-newspaper me-2"></i>{{ $article->titre }}
    </h1>

    <!-- Carte contenant les détails -->
    <div class="card border-0 shadow-lg bg-light rounded-4">
        <div class="card-body">

            <!-- Affichage de l'auteur -->
            <p class="mb-3">
                <strong><i class="fa-solid fa-user me-1 text-secondary"></i>@lang('Author'):</strong>
                {{ $article->user->name ?? '-' }}
            </p>

            <!-- Affichage de la date de création -->
            <p class="mb-3">
                <strong><i class="fa-solid fa-calendar-days me-1 text-secondary"></i>@lang('Created at'):</strong>
                {{ $article->created_at->format('d/m/Y') }}
            </p>

            <!-- Affichage du contenu -->
            <div class="mb-3">
                <strong><i class="fa-solid fa-align-left me-1 text-secondary"></i>@lang('Content'):</strong>
                <div class="mt-2 bg-white p-3 rounded shadow-sm">
                    {!! nl2br(e($article->contenu)) !!}
                </div>
            </div>

            <!-- Bouton de retour vers la liste -->
            <div class="mt-4">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary shadow-sm">
                    ← @lang('Back to list')
                </a>
            </div>
        </div>
    </div>
</div>
@endsection