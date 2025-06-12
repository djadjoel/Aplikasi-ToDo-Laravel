@extends('auth.layout')
@section('content')
<form method="POST" action="{{ route('forgot-password') }}">
    @csrf
    <img class="mb-4" src="{{ secure_asset('gambar/logo/150x150.jpg') }}" alt=baniakoy.com" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Lupa Password</h1>
    <div class="form-floating mb-3">
        <input type="email" name="email" value="{{ old('email') }}"class="form-control" id="floatingInput" placeholder="name@example.com" required autofocus>
        <label for="floatingInput">Email</label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Kirim Link Reset</button>
    <p class="mt-3 mb-1 text-muted">&copy; 2025</p>
</form>
@endsection