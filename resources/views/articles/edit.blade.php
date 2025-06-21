@extends('layouts.app')
@section('title', __('Edit Article'))

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary fw-bold">
        <i class="fa-solid fa-pen-to-square me-2"></i>@lang('Edit Article')
    </h1>

    <!-- Carte contenant le formulaire -->
    <div class="card border-0 shadow rounded-4">
        <div class="card-body bg-white p-4">
            <!-- Formulaire de modification d'un article existant -->
            <form action="{{ route('articles.update', $article->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champ : Titre -->
                <div class="mb-3">
                    <label for="titre" class="form-label fw-semibold">@lang('Title')</label>
                    <input
                        type="text"
                        name="titre"
                        id="titre"
                        class="form-control shadow-sm @if($errors->has('titre')) is-invalid @endif"
                        value="{{ old('titre', $article->titre) }}"
                        required>
                    @if ($errors->has('titre'))
                    <small class="text-danger">{{ $errors->first('titre') }}</small>
                    @endif
                </div>

                <!-- Champ : Contenu -->
                <div class="mb-4">
                    <label for="contenu" class="form-label fw-semibold">@lang('Content')</label>
                    <textarea
                        name="contenu"
                        id="contenu"
                        rows="5"
                        class="form-control shadow-sm @if($errors->has('contenu')) is-invalid @endif"
                        required>{{ old('contenu', $article->contenu) }}</textarea>
                    @if ($errors->has('contenu'))
                    <small class="text-danger">{{ $errors->first('contenu') }}</small>
                    @endif
                </div>

                <!-- Boutons de mise à jour et d'annulation -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient shadow-sm">
                        @lang('Update')
                    </button>
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary shadow-sm">
                        @lang('Cancel')
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection