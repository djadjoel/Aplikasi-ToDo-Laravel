@extends('auth.layout')
@section('content')
<form method="POST" action="{{ url('/default/login') }}">
    @csrf
    <img class="mb-4" src="{{ secure_asset('gambar/logo/150x150.jpg') }}" alt=baniakoy.com" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Log in</h1>
    <div class="form-floating">
        <input type="email" name="email" value="{{ old('email') }}"class="form-control" id="floatingInput" placeholder="name@example.com" required autofocus>
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating position-relative">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password</label>
        <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword('password', this)" style="z-index: 10;"><i class="bi bi-eye" id="icon-password"></i></button>
    </div>
    <div class="form-floating">
        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Jawaban Captcha" required>
        <label for="captcha">Berapa {{ $a }} + {{ $b }}?</label>
    </div>
    <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Ingat saya</label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Masuk</button>
    <div class="d-flex justify-content-between py-2 small text-secondary">
        <a href="{{ url('default/register') }}" class="text-decoration-none text-secondary">
            <i class="bi bi-person-plus me-1"></i> Buat Akun
        </a>
        <a href="{{ url('default/forgot-password') }}" class="text-decoration-none text-secondary">
            <i class="bi bi-question-circle me-1"></i> Lupa Password
        </a>
    </div>
    <p class="mt-3 mb-1 text-muted">&copy; 2025</p>
</form>
@endsection