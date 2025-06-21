@extends('layouts.app')
@section('title', __('Student Details'))

@section('content')
<div class="container mt-4">

    <!-- Titre principal de la page -->
    <h1 class="mb-4 text-center text-primary">@lang('Student Details')</h1>

    <!-- Carte contenant les détails de l'étudiant -->
    <div class="card shadow-lg border-0">
        <div class="card-body bg-light rounded">

            <!-- Nom de l’étudiant -->
            <h4 class="card-title mb-4 text-primary fw-bold">
                <i class="fa-solid fa-user-graduate me-2"></i> {{ $etudiant->nom }}
            </h4>

            <!-- Informations personnelles -->
            <p class="mb-2">
                <i class="fa-solid fa-location-dot text-muted me-2"></i>
                <strong>@lang('Address') :</strong> {{ $etudiant->adresse }}
            </p>
            <p class="mb-2">
                <i class="fa-solid fa-phone text-muted me-2"></i>
                <strong>@lang('Phone') :</strong> {{ $etudiant->telephone }}
            </p>
            <p class="mb-2">
                <i class="fa-solid fa-envelope text-muted me-2"></i>
                <strong>Email :</strong> {{ $etudiant->email }}
            </p>
            <p class="mb-2">
                <i class="fa-solid fa-cake-candles text-muted me-2"></i>
                <strong>@lang('Date of Birth') :</strong>
                {{ \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') }}
            </p>
            <p class="mb-2">
                <i class="fa-solid fa-city text-muted me-2"></i>
                <strong>@lang('City') :</strong> {{ $etudiant->ville->nom ?? __('Not Defined') }}
            </p>

            <!-- Date de création de l’enregistrement -->
            <p class="text-muted small mt-3">
                <i class="fa-regular fa-clock me-1"></i> @lang('Created At') : {{ $etudiant->created_at->format('d/m/Y') }}
            </p>

            <!-- Boutons d’action : modifier, supprimer, retour -->
            <div class="mt-4 d-flex flex-wrap gap-2">
                <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-warning text-white shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> @lang('Edit')
                </a>

                <button type="button"
                    class="btn btn-danger shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    onclick="setDeleteData(this)"
                    data-id="{{ $etudiant->id }}"
                    data-name="{{ $etudiant->nom }}"
                    data-url="{{ route('etudiant.destroy', $etudiant->id) }}">
                    <i class="fa-solid fa-trash me-1"></i> @lang('Delete')
                </button>

                <a href="{{ route('etudiant.index') }}" class="btn btn-secondary shadow-sm">
                    ← @lang('Back to list')
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour la suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- En-tête du modal -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">@lang('Confirm Deletion')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('Close')"></button>
            </div>

            <!-- Corps du modal -->
            <div class="modal-body">
                @lang('Do you really want to delete the student') <strong id="studentName"></strong> ?
            </div>

            <!-- Pied du modal -->
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">@lang('Yes, delete')</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fonction JavaScript pour transmettre dynamiquement les données au formulaire de suppression
    function setDeleteData(button) {
        const name = button.getAttribute('data-name');
        const url = button.getAttribute('data-url');
        document.getElementById('studentName').textContent = name;
        document.getElementById('deleteForm').setAttribute('action', url);
    }
</script>
@endsection