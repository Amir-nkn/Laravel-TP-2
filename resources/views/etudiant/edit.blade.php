@extends('layouts.app')
@section('title', __('Edit Student'))

@section('content')
<div class="container mt-4">

    <!-- Titre de la page avec icône -->
    <div class="mb-4 d-flex align-items-center gap-2">
        <i class="fa-solid fa-pen-to-square fa-lg text-primary"></i>
        <h1 class="mb-0">@lang('Edit Student')</h1>
    </div>

    <!-- Carte contenant le formulaire de modification -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body bg-white p-4 rounded-4">
            <form action="{{ route('etudiant.update', $etudiant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champ : Nom de l'étudiant -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Name')</label>
                    <input type="text" name="nom" value="{{ old('nom', $etudiant->nom) }}" class="form-control shadow-sm" required>
                    @if ($errors->has('nom'))
                    <small class="text-danger">{{ $errors->first('nom') }}</small>
                    @endif
                </div>

                <!-- Champ : Adresse -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Address')</label>
                    <input type="text" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}" class="form-control shadow-sm" required>
                    @if ($errors->has('adresse'))
                    <small class="text-danger">{{ $errors->first('adresse') }}</small>
                    @endif
                </div>

                <!-- Champ : Téléphone -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Phone')</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" class="form-control shadow-sm" required>
                    @if ($errors->has('telephone'))
                    <small class="text-danger">{{ $errors->first('telephone') }}</small>
                    @endif
                </div>

                <!-- Champ : Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email', $etudiant->email) }}" class="form-control shadow-sm" required>
                    @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <!-- Champ : Date de naissance -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">@lang('Date of Birth')</label>
                    <input type="date" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}" class="form-control shadow-sm" required>
                    @if ($errors->has('date_naissance'))
                    <small class="text-danger">{{ $errors->first('date_naissance') }}</small>
                    @endif
                </div>

                <!-- Champ : Ville (menu déroulant) -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">@lang('City')</label>
                    <select name="ville_id" class="form-select shadow-sm" required>
                        <option value="">-- @lang('Choose a city') --</option>
                        @foreach($villes as $ville)
                        <option value="{{ $ville->id }}" {{ old('ville_id', $etudiant->ville_id) == $ville->id ? 'selected' : '' }}>
                            {{ $ville->nom }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('ville_id'))
                    <small class="text-danger">{{ $errors->first('ville_id') }}</small>
                    @endif
                </div>

                <!-- Boutons : sauvegarde ou annulation -->
                <div class="d-flex flex-wrap justify-content-start gap-2">
                    <button type="submit" class="btn btn-gradient shadow-sm">
                        💾 @lang('Save')
                    </button>
                    <a href="{{ route('etudiant.index') }}" class="btn btn-outline-secondary shadow-sm">
                        ← @lang('Cancel')
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection