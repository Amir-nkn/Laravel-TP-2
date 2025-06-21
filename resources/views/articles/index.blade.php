@extends('layouts.app')
@section('title', __('Articles'))

@section('content')
<div class="container mt-4">
    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-primary">
            <i class="fa-solid fa-newspaper me-2"></i>@lang('Articles')
        </h1>

        @auth
        <a href="{{ route('articles.create') }}" class="btn btn-gradient shadow-sm">
            <i class="fa-solid fa-plus me-1"></i> @lang('Add Article')
        </a>
        @endauth
    </div>

    @if($articles->count())
    <!-- Tableau des articles -->
    <div class="table-responsive bg-white rounded-4 shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="text-white" style="background: linear-gradient(90deg, #e52d27, #b31217);">
                <tr class="text-center">
                    <th>@lang('Title')</th>
                    <th>@lang('Author')</th>
                    <th>@lang('Created At')</th>
                    <th>@lang('Actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr class="text-center">
                    <!-- Affichage du titre -->
                    <td class="fw-semibold text-start">
                        <i class="fa-solid fa-file-lines me-1 text-danger"></i> {{ $article->titre }}
                    </td>
                    <!-- Affichage de l'auteur -->
                    <td>{{ $article->user->name ?? '-' }}</td>
                    <!-- Date de création -->
                    <td><small>{{ $article->created_at->format('d/m/Y') }}</small></td>
                    <!-- Boutons d'action -->
                    <td>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-outline-info shadow-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        @auth
                        @if (Auth::id() === $article->user_id)
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-outline-warning shadow-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <!-- Bouton pour ouvrir la modale de suppression -->
                        <button type="button"
                            class="btn btn-sm btn-outline-danger shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="{{ $article->id }}"
                            data-name="{{ $article->titre }}"
                            data-url="{{ route('articles.destroy', $article->id) }}"
                            onclick="setDeleteData(this)">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        @endif
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $articles->links() }}
    </div>

    @else
    <!-- Message si aucun article trouvé -->
    <div class="alert alert-warning text-center mt-4">
        @lang('No articles found.')
    </div>
    @endif
</div>

<!-- Modale de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- En-tête de la modale -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">@lang('Confirm Deletion')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('Close')"></button>
            </div>
            <!-- Corps de la modale -->
            <div class="modal-body">
                @lang('Do you really want to delete the article') <strong id="itemName"></strong> ?
            </div>
            <!-- Pied de la modale -->
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
    /**
     * Remplit les informations de la modale avec les données de l'article sélectionné
     */
    function setDeleteData(button) {
        const title = button.getAttribute('data-name');
        const url = button.getAttribute('data-url');

        document.getElementById('itemName').textContent = title;
        document.getElementById('deleteForm').setAttribute('action', url);
    }
</script>
@endsection