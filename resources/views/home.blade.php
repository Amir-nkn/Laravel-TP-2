@extends('layouts.app')

{{-- Définir le titre de la page --}}
@section('title', __('Home'))

@section('content')
<div class="container py-5">

    {{-- Message de bienvenue centré --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">
            👋 {{ __('Welcome back, :name!', ['name' => Auth::user()->name]) }}
        </h1>
        <p class="lead text-muted">{{ __('You are successfully logged in.') }}</p>
    </div>

    {{-- Afficher un message de session si disponible --}}
    @if (session('status'))
    <div class="alert alert-success text-center fw-semibold">
        {{ session('status') }}
    </div>
    @endif

    {{-- Section principale avec des cartes --}}
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row g-4">

                {{-- Carte : Gestion des étudiants --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-users fa-2x text-info mb-3"></i>
                            <h5 class="card-title">@lang('Manage Students')</h5>
                            <p class="card-text text-muted">@lang('View and update student information.')</p>
                            <a href="{{ route('etudiant.index') }}" class="btn btn-outline-info">@lang('Go')</a>
                        </div>
                    </div>
                </div>

                {{-- Carte : Articles --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-newspaper fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">@lang('Browse Articles')</h5>
                            <p class="card-text text-muted">@lang('Check out the latest articles posted.')</p>
                            <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">@lang('Go')</a>
                        </div>
                    </div>
                </div>

                {{-- Carte : Forum --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-comments fa-2x text-success mb-3"></i>
                            <h5 class="card-title">@lang('Join the Forum')</h5>
                            <p class="card-text text-muted">@lang('Participate in discussions and share ideas.')</p>
                            <a href="{{ route('forums.index') }}" class="btn btn-outline-success">@lang('Go')</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection