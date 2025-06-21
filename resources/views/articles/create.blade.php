@extends('layouts.app')
@section('title', __('Add Article'))

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary fw-bold">
        <i class="fa-solid fa-circle-plus me-2"></i>@lang('Add Article')
    </h1>

    <!-- Carte contenant le formulaire -->
    <div class="card border-0 shadow rounded-4">
        <div class="card-body bg-white p-4">
            <!-- Formulaire de création d'un article -->
            <form action="{{ route('articles.store') }}" method="POST">
                @csrf

                <!-- Champ : Titre -->
                <div class="mb-3">
                    <label for="titre" class="form-label fw-semibold">@lang('Title')</label>
                    <input
                        type="text"
                        name="titre"
                        id="titre"
                        class="form-control shadow-sm @if($errors->has('titre')) is-invalid @endif"
                        value="{{ old('titre') }}"
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
                        required>{{ old('contenu') }}</textarea>
                    @if ($errors->has('contenu'))
                    <small class="text-danger">{{ $errors->first('contenu') }}</small>
                    @endif
                </div>

                <!-- Boutons de soumission et d'annulation -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient shadow-sm">
                        @lang('Save')
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