@extends('layouts.app')
@section('title', __('Edit Forum'))

@section('content')
<div class="container mt-4">

    <!-- Titre principal -->
    <h1 class="mb-4 text-primary fw-bold">
        <i class="fa-solid fa-pen-to-square me-2"></i> @lang('Edit Forum')
    </h1>

    <!-- Carte contenant le formulaire d'édition -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body bg-white p-4 rounded-4">
            <form action="{{ route('forums.update', $forum->id) }}" method="POST">
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
                        value="{{ old('titre', $forum->titre) }}"
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
                        rows="6"
                        class="form-control shadow-sm @if($errors->has('contenu')) is-invalid @endif"
                        required>{{ old('contenu', $forum->contenu) }}</textarea>
                    @if ($errors->has('contenu'))
                    <small class="text-danger">{{ $errors->first('contenu') }}</small>
                    @endif
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-gradient shadow-sm">
                        💾 @lang('Update')
                    </button>
                    <a href="{{ route('forums.index') }}" class="btn btn-outline-secondary shadow-sm">
                        ← @lang('Cancel')
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection