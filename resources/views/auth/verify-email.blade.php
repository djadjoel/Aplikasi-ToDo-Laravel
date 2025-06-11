@extends('auth.layout')

@section('content')
    <div class="text-center p-4">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <h2>Halo, {{ $user->name }}</h2>
        <p>Terima kasih telah mendaftar.</p>
        <p>Silakan klik tombol di bawah ini untuk memverifikasi email Anda:</p>

        <a href="{{ $url }}" class="btn btn-primary my-3">Verifikasi Email</a>

        <p class="text-muted small">
            Jika Anda tidak merasa mendaftar, abaikan email ini.
        </p>
    </div>
@endsection