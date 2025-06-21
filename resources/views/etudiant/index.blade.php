@extends('layouts.app')
@section('title', __('Student List'))

@section('content')
<div class="container mt-4">

    <!-- En-tête de la page : titre + bouton d’ajout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">@lang('Student List')</h1>
        <a href="{{ route('etudiant.create') }}" class="btn btn-gradient shadow-sm">+ @lang('Add Student')</a>
    </div>

    @if($etudiants->count())
    <!-- Grille des cartes des étudiants -->
    <div class="row g-4">
        @foreach($etudiants as $etudiant)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 position-relative">

                <!-- Numéro d’ordre affiché en haut à gauche de chaque carte -->
                <div class="position-absolute top-0 start-0 m-3">
                    <span class="badge rounded-pill px-2 py-2 fs-6 me-2"
                        style="background: linear-gradient(135deg, #a64ac9, #d38312); color: white;">
                        #{{ $loop->iteration + ($etudiants->currentPage() - 1) * $etudiants->perPage() }}
                    </span>
                </div>

                <!-- Contenu de la carte -->
                <div class="card-body pt-4 d-flex flex-column justify-content-between">

                    <!-- Espace vide pour éviter le chevauchement -->
                    <div style="height: 30px;"></div>

                    <!-- Nom et ville de l’étudiant -->
                    <div class="text-center">
                        <h5 class="card-title text-primary fw-semibold mb-2">
                            <i class="fa-solid fa-user-graduate me-1"></i> {{ $etudiant->nom }}
                        </h5>
                        <p class="text-muted small mb-0">
                            <i class="fa-solid fa-location-dot me-1"></i>
                            {{ $etudiant->ville->nom ?? __('Not Defined') }}
                        </p>
                    </div>

                    <!-- Bouton de consultation -->
                    <div class="mt-4">
                        <a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-outline-primary w-100 shadow-sm">
                            <i class="fa-solid fa-eye me-1"></i> @lang('See')
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $etudiants->links() }}
    </div>

    @else
    <!-- Message si aucun étudiant -->
    <div class="alert alert-warning text-center mt-4">@lang('No student found.')</div>
    @endif
</div>
@endsection