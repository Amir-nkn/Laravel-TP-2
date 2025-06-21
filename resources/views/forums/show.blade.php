@extends('layouts.app')
@section('title', $forum->titre)

@section('content')
<div class="container my-5">

    <!-- Post principal -->
    <div class="bg-gradient p-4 rounded shadow mb-4" style="background: linear-gradient(135deg, #f9f5ff, #e0c3fc);">
        <h1 class="mb-2 text-dark fw-bold">{{ $forum->titre }}</h1>
        <p class="text-muted">
            <i class="fa-solid fa-user"></i> {{ $forum->user->name ?? '' }} |
            <i class="fa-regular fa-clock"></i> {{ $forum->created_at->format('d/m/Y H:i') }}
        </p>

        <div class="mt-3 p-3 bg-white rounded shadow-sm border">
            {!! nl2br(e($forum->contenu)) !!}

            @if($forum->created_at != $forum->updated_at)
            <p class="text-muted mt-3 mb-0" style="font-size: 0.85rem;">
                <i class="fa-solid fa-pen-to-square me-1"></i>
                @lang('Edited on') {{ $forum->updated_at->format('d/m/Y H:i') }}
            </p>
            @endif
        </div>
    </div>

    <!-- Retour -->
    <a href="{{ route('forums.index') }}" class="btn btn-outline-dark mb-4">
        ← @lang('Back to forums')
    </a>

    <!-- Commentaires -->
    <h4 class="mb-3 text-primary">@lang('Comments')</h4>

    @forelse($forum->comments as $comment)
    <div class="card mb-3 shadow-sm border-start border-4 border-primary">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    <small class="text-muted d-block">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                </div>

                @auth
                @if(Auth::id() === $comment->user_id)
                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteCommentModal"
                    data-id="{{ $comment->id }}"
                    data-name="{{ Str::limit($comment->contenu, 30) }}"
                    data-url="{{ route('comments.destroy', $comment->id) }}"
                    onclick="setDeleteCommentData(this)">
                    <i class="fa-solid fa-trash"></i>
                </button>
                @endif
                @endauth
            </div>

            <p class="mt-2 mb-0">{{ $comment->contenu }}</p>
        </div>
    </div>
    @empty
    <div class="alert alert-info">@lang('No comments yet.')</div>
    @endforelse

    <!-- Ajouter un commentaire -->
    @auth
    <div class="card mt-4 shadow-sm border border-success">
        <div class="card-body">
            <h5 class="card-title text-success">
                <i class="fa-regular fa-comment-dots me-1"></i> @lang('Add a comment')
            </h5>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                <div class="form-group mb-3">
                    <textarea
                        name="contenu"
                        rows="3"
                        class="form-control @if($errors->has('contenu')) is-invalid @endif"
                        placeholder="@lang('Your comment')..." required>{{ old('contenu') }}</textarea>
                    @if ($errors->has('contenu'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('contenu') }}
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-paper-plane"></i> @lang('Send')
                </button>
            </form>
        </div>
    </div>
    @endauth

    @guest
    <p class="mt-4">
        @lang('Please')
        <a href="{{ route('login') }}" class="text-decoration-underline fw-semibold">@lang('login')</a>
        @lang('to leave a comment.')
    </p>
    @endguest

</div>

<!-- Modal pour suppression de commentaire -->
<div class="modal fade" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteCommentModalLabel">@lang('Confirm Deletion')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('Close')"></button>
            </div>
            <div class="modal-body">
                @lang('Do you really want to delete the comment') <strong id="commentPreview"></strong> ?
            </div>
            <div class="modal-footer">
                <form id="deleteCommentForm" method="POST">
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
    function setDeleteCommentData(button) {
        const name = button.getAttribute('data-name');
        const url = button.getAttribute('data-url');

        document.getElementById('commentPreview').textContent = name;
        document.getElementById('deleteCommentForm').setAttribute('action', url);
    }
</script>
@endsection