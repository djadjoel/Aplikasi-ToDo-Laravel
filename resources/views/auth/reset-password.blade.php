@extends('auth.layout')
@section('content')
<form method="POST" action="{{ route('reset-password') }}">
    @csrf
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <input type="hidden" name="token" value="{{ $token }}" />
    <img class="mb-4" src="{{ secure_asset('gambar/logo/150x150.jpg') }}" alt=baniakoy.com" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Reset Password</h1>
    <div class="form-floating">
        <input type="email" name="email" value="{{ old('email') }}"class="form-control" id="floatingInput" placeholder="name@example.com" required autofocus>
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
    <button class="btn btn-primary w-100 py-2" type="submit">Reset Password</button>
    <p class="mt-3 mb-1 text-muted">&copy; 2025</p>
</form>
@endsection