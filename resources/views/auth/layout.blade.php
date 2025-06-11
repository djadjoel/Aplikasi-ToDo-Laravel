<!DOCTYPE html>
<html lang="id" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Auth Page')">
    <meta name="author" content="baniakoy.com">
    <title>@yield('title', 'Auth')</title>
    <script src="{{ asset('plugins/bootstrap533/color-modes.js') }}"></script>
    <link rel="icon" href="{{ asset('gambar/favicon/favicon.ico') }}">
    <link href="{{ asset('plugins/bootstrap533/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap533/color-modes.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/sign-in/sign-in.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('auth.color-switcher')

    @if ($errors->any())
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
            <div id="errorToast" class="toast auto-toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('message'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
            <div id="successToast" class="toast auto-toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="text-center form-signin w-100 m-auto shadow p-4 bg-white rounded">
        @yield('content')
    </main>

    <script src="{{ asset('plugins/bootstrap533/bootstrap.bundle.min.js') }}"></script>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        }

        document.addEventListener("DOMContentLoaded", function () {
            // Tampilkan semua toast dengan class 'auto-toast'
            const toastEls = document.querySelectorAll('.auto-toast');
            toastEls.forEach(toastEl => {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>