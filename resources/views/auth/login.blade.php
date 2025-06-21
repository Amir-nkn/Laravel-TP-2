@extends('layouts.app')
@section('title', __('Login'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-4 bg-light">

                    <h2 class="mb-4 text-center text-primary fw-bold">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> {{ __('Login') }}
                    </h2>

                    {{-- 🔴 پیام خطای کلی (مثل نام کاربری یا رمز اشتباه) --}}
                    @if ($errors->any())
                    <div class="alert alert-danger text-center fw-semibold">
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-control shadow-sm {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control shadow-sm {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                name="password" required>

                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>

                        {{-- Remember Me --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember"
                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection