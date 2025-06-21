@extends('layouts.app')
@section('title', __('Create Forum Post'))

@section('content')
<div class="container mt-4">

    <!-- Titre principal de la page -->
    <h1 class="mb-4 text-primary fw-bold">
        <i class="fa-solid fa-message me-2"></i> @lang('Create Forum Post')
    </h1>

    <!-- Carte contenant le formulaire de création -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body bg-white p-4 rounded-4">
            <form method="POST" action="{{ route('forums.store') }}">
                @csrf

                <!-- Champ : Titre du sujet -->
                <div class="mb-3">
                    <label for="titre" class="form-label fw-semibold">@lang('Title')</label>
                    <input
                        type="text"
                        name="titre"
                        id="titre"
                        class="form-control shadow-sm @if($errors->has('titre')) is-invalid @endif"
                        value="{{ old('titre') }}"
                        placeholder="@lang('Enter the title')"
                        required>
                    @if ($errors->has('titre'))
                    <small class="text-danger">{{ $errors->first('titre') }}</small>
                    @endif
                </div>

                <!-- Champ : Contenu du message -->
                <div class="mb-4">
                    <label for="contenu" class="form-label fw-semibold">@lang('Content')</label>
                    <textarea
                        name="contenu"
                        id="contenu"
                        rows="5"
                        class="form-control shadow-sm @if($errors->has('contenu')) is-invalid @endif"
                        placeholder="@lang('Write your post...')"
                        required>{{ old('contenu') }}</textarea>
                    @if ($errors->has('contenu'))
                    <small class="text-danger">{{ $errors->first('contenu') }}</small>
                    @endif
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-gradient shadow-sm">
                    📬 @lang('Post')
                </button>
            </form>
        </div>
    </div>
</div>
@endsection