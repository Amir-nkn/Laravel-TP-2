@extends('layouts.app')
@section('title', __('Upload Document'))

@section('content')
<div class="container mt-4">
    <!-- Titre principal de la page -->
    <h1 class="mb-4 text-primary">
        <i class="fa-solid fa-upload me-2"></i>@lang('Upload a Document')
    </h1>

    <!-- Carte contenant le formulaire -->
    <div class="card border-0 shadow rounded-3">
        <div class="card-body bg-light p-4">

            <!-- Formulaire d’envoi de document -->
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Champ : Titre du document -->
                <div class="mb-3">
                    <label for="titre" class="form-label fw-semibold">@lang('Title')</label>
                    <input type="text" name="titre" id="titre"
                        class="form-control shadow-sm @if($errors->has('titre')) is-invalid @endif"
                        value="{{ old('titre') }}" required>
                    @if($errors->has('titre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titre') }}
                    </div>
                    @endif
                </div>

                <!-- Champ : Fichier à uploader -->
                <div class="mb-4">
                    <label for="fichier" class="form-label fw-semibold">@lang('PDF File')</label>
                    <input type="file" name="fichier" id="fichier"
                        class="form-control shadow-sm @if($errors->has('fichier')) is-invalid @endif"
                        accept="application/pdf" required>
                    @if($errors->has('fichier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fichier') }}
                    </div>
                    @endif
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient shadow-sm">
                        📄 @lang('Upload')
                    </button>
                    <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary shadow-sm">
                        ← @lang('Cancel')
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection