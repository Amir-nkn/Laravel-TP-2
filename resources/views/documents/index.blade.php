@extends('layouts.app')
@section('title', __('Documents'))

@section('content')
<div class="container mt-4">
    <!-- Titre de la page et bouton d'envoi -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary mb-0">
            <i class="fa-solid fa-file-pdf me-2"></i>@lang('Documents')
        </h1>
        <a href="{{ route('documents.create') }}" class="btn btn-gradient shadow-sm">
            📤 @lang('Upload Document')
        </a>
    </div>

    <!-- Vérification s'il existe des documents -->
    @if ($documents->count())
    <div class="table-responsive shadow-sm rounded-3 bg-white">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>@lang('Title')</th>
                    <th>@lang('Uploader')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Actions')</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($documents as $document)
                <tr>
                    <!-- Titre du document -->
                    <td class="fw-semibold">{{ $document->titre }}</td>

                    <!-- Nom de l'utilisateur qui a téléversé -->
                    <td>{{ $document->user->name ?? '-' }}</td>

                    <!-- Date de création -->
                    <td>{{ $document->created_at->format('d/m/Y') }}</td>

                    <!-- Actions disponibles -->
                    <td>
                        <!-- Bouton pour télécharger le document -->
                        <a href="{{ asset('storage/' . $document->fichier) }}" target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                            📥 @lang('Download')
                        </a>

                        <!-- Bouton de suppression disponible uniquement pour le propriétaire -->
                        @if (Auth::id() === $document->user_id)
                        <button
                            type="button"
                            class="btn btn-outline-danger btn-sm shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            onclick="setDeleteData(this)"
                            data-id="{{ $document->id }}"
                            data-name="{{ $document->titre }}"
                            data-url="{{ route('documents.destroy', $document->id) }}">
                            🗑 @lang('Delete')
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination des documents -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $documents->links() }}
    </div>

    @else
    <!-- Message d’alerte si aucun document -->
    <div class="alert alert-warning text-center mt-4 shadow-sm">@lang('No document found.')</div>
    @endif
</div>

<!--  Modal de confirmation de suppression -->
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
                @lang('Do you really want to delete') <strong id="itemName"></strong> ?
            </div>

            <!-- Pied du modal avec formulaire de suppression -->
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
    // Fonction pour configurer dynamiquement le modal avec les données du document
    function setDeleteData(button) {
        const itemName = button.getAttribute('data-name');
        const itemUrl = button.getAttribute('data-url');

        document.getElementById('itemName').textContent = itemName;
        document.getElementById('deleteForm').setAttribute('action', itemUrl);
    }
</script>
@endsection