@extends('auth.layout')
@section('content')
<form method="POST" action="{{ url('default/register') }}">
    @csrf
    <img class="mb-4" src="{{ asset('gambar/logo/150x150.jpg') }}" alt=baniakoy.com" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Register</h1>
    <div class="form-floating">
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="floatingNama" placeholder="Nama" required autofocus>
        <label for="floatingNama">Nama</label>
    </div>
    <div class="form-floating">
        <input type="email" name="email" value="{{ old('email') }}"class="form-control" id="floatingInput" placeholder="name@example.com" required>
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating position-relative">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password</label>
        <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword('password', this)" style="z-index: 10;"><i class="bi bi-eye" id="icon-password"></i></button>
    </div>
    <div class="form-floating position-relative">
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
        <label for="password">Konfirmasi Password</label>
        <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword('password_confirmation', this)" style="z-index: 10;"><i class="bi bi-eye" id="icon-password"></i></button>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
    <div class="d-flex justify-content-between py-2 small text-secondary">
        <a href="{{ url('default/login') }}" class="text-decoration-none text-secondary">
            <i class="bi bi-door-closed me-1"></i> Login
        </a>
    </div>
    <p class="mt-3 mb-1 text-muted">&copy; 2025</p>
</form>
@endsection