@extends('layouts.app')
@section('title', __('Forum'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <!-- Titre principal et bouton d'ajout -->
    <h1 class="text-primary fw-bold mb-0">
        <i class="fa-solid fa-comments me-2"></i> @lang('Forum')
    </h1>

    @auth
    <a href="{{ route('forums.create') }}" class="btn btn-gradient shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> @lang('Add Forum Post')
    </a>
    @endauth
</div>

<!-- Tableau des forums -->
<div class="card shadow border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>@lang('Title')</th>
                        <th>@lang('Author')</th>
                        <th>@lang('Created At')</th>
                        <th class="text-center">@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forums as $forum)
                    <tr>
                        <td class="fw-semibold">{{ $forum->titre }}</td>
                        <td>{{ $forum->user->name ?? '-' }}</td>
                        <td>{{ $forum->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <!-- Voir le post -->
                            <a href="{{ route('forums.show', $forum->id) }}" class="btn btn-sm btn-outline-info me-1 shadow-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            @auth
                            @if (Auth::id() === $forum->user_id)
                            <!-- Modifier -->
                            <a href="{{ route('forums.edit', $forum->id) }}" class="btn btn-sm btn-outline-warning me-1 shadow-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Supprimer -->
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="{{ $forum->id }}"
                                data-name="{{ $forum->titre }}"
                                data-url="{{ route('forums.destroy', $forum->id) }}"
                                onclick="setDeleteData(this)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @endif
                            @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-4 d-flex justify-content-center">
    {{ $forums->links() }}
</div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- En-tête -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">@lang('Confirm Deletion')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('Close')"></button>
            </div>
            <!-- Corps -->
            <div class="modal-body">
                @lang('Do you really want to delete the post') <strong id="itemName"></strong> ?
            </div>
            <!-- Pied -->
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
    // Fonction JS pour configurer les données du formulaire de suppression
    function setDeleteData(button) {
        const name = button.getAttribute('data-name');
        const url = button.getAttribute('data-url');

        document.getElementById('itemName').textContent = name;
        document.getElementById('deleteForm').setAttribute('action', url);
    }
</script>
@endsection