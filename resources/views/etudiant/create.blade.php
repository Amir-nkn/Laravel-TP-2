@extends('layouts.app')
@section('title', __('Ajouter un étudiant'))

@section('content')
<div class="container mt-4">

    <!-- Titre principal avec une icône -->
    <div class="mb-4 d-flex align-items-center gap-2">
        <i class="fa-solid fa-user-plus fa-lg text-success"></i>
        <h1 class="mb-0">@lang('Ajouter un étudiant')</h1>
    </div>

    <!-- Carte contenant le formulaire d’ajout -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body bg-white p-4 rounded-4">
            <form action="{{ route('etudiant.store') }}" method="POST">
                @csrf

                <!-- Champ : Nom de l'étudiant -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Nom')</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" class="form-control shadow-sm" required>
                    @if ($errors->has('nom'))
                    <small class="text-danger">{{ $errors->first('nom') }}</small>
                    @endif
                </div>

                <!-- Champ : Adresse -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Adresse')</label>
                    <input type="text" name="adresse" value="{{ old('adresse') }}" class="form-control shadow-sm" required>
                    @if ($errors->has('adresse'))
                    <small class="text-danger">{{ $errors->first('adresse') }}</small>
                    @endif
                </div>

                <!-- Champ : Téléphone -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Téléphone')</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}" class="form-control shadow-sm" required>
                    @if ($errors->has('telephone'))
                    <small class="text-danger">{{ $errors->first('telephone') }}</small>
                    @endif
                </div>

                <!-- Champ : Adresse email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Email')</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control shadow-sm" required>
                    @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <!-- Champ : Date de naissance -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Date de naissance')</label>
                    <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" class="form-control shadow-sm" required>
                    @if ($errors->has('date_naissance'))
                    <small class="text-danger">{{ $errors->first('date_naissance') }}</small>
                    @endif
                </div>

                <!-- Champ : Ville (liste déroulante dynamique) -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">@lang('Ville')</label>
                    <select name="ville_id" class="form-select shadow-sm" required>
                        <option value="">-- @lang('Choisissez une ville') --</option>
                        @foreach($villes as $ville)
                        <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                            {{ $ville->nom }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('ville_id'))
                    <small class="text-danger">{{ $errors->first('ville_id') }}</small>
                    @endif
                </div>

                <!-- Boutons d’action : création et retour -->
                <div class="d-flex flex-wrap justify-content-start gap-2">
                    <button type="submit" class="btn btn-gradient shadow-sm">
                        📌 @lang('Créer')
                    </button>
                    <a href="{{ route('etudiant.index') }}" class="btn btn-outline-secondary shadow-sm">
                        ← @lang('Annuler')
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection