@extends('auth.layout')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->has('email'))
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
    @endif

    <h2>Halo, {{ $user->name }}</h2>
    <p>Email Anda belum diverifikasi. Silakan cek inbox email <strong>{{ $user->email }}</strong> dan klik link verifikasi.</p>

    <form action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
    </form>
@endsection
