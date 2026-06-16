@extends('layouts.app')

@push('styles')
<style>
    html, body {
        min-height: 100%;
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(37, 99, 235, 0.72) 45%, rgba(56, 189, 248, 0.55) 100%),
                    url("{{ asset('img/login.png') }}") center center / cover no-repeat;
        color: #0f172a;
        background-attachment: fixed;
    }

    body {
        display: grid;
        place-items: center;
        min-height: 100vh;
        padding: 0;
        background: transparent;
    }

    .main-content {
        background: transparent !important;
    }

    .container-fluid,
    .row {
        background: transparent !important;
    }

    .login-hero {
        width: 100%;
        max-width: 650px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        min-width: 540px;
        max-width: 650px;
        min-height: 560px;
        border-radius: 36px;
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 44px 100px rgba(15, 23, 42, 0.18);
        padding: 3rem;
        border: 1px solid rgba(37, 99, 235, 0.14);
        display: flex;
        flex-direction: column;
        justify-content: center;
        backdrop-filter: blur(18px);
    }

    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        letter-spacing: -0.05em;
    }

    .login-header p {
        color: #475569;
        font-size: 1.05rem;
        margin-bottom: 0;
        max-width: 470px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.75;
    }

    .form-label {
        font-weight: 700;
        color: #0f172a;
    }

    .form-control {
        width: 100%;
        height: 60px;
        border-radius: 18px;
        border: 1px solid rgba(37, 99, 235, 0.18);
        padding: 0 1.35rem;
        background: rgba(241, 245, 255, 0.95);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        font-size: 1rem;
        color: #0f172a;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.15rem rgba(37, 99, 235, 0.2);
    }

    .btn-primary {
        width: 100%;
        border-radius: 20px;
        padding: 1.25rem;
        background: linear-gradient(135deg, #2563eb 0%, #22d3ee 100%);
        border: none;
        font-weight: 700;
        font-size: 1.05rem;
        box-shadow: 0 18px 40px rgba(37, 99, 235, 0.22);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    }

    .remember-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .form-check-label {
        font-weight: 600;
        color: #1e3a8a;
    }

    .forgot-password {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="login-hero">
    <div class="login-card">
        <div class="login-header">
            <h1>Masuk ke SIAKAD</h1>
            <p>Gunakan email dan kata sandi untuk mengakses akun Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="remember-row mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
    </div>
</div>
@endsection
