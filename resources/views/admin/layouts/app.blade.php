<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ secure_asset('gambar/favicon/favicon.ico') }}">
    <link href="{{ secure_asset('plugins/bootstrap533/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('plugins/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('templates/architect4/main.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('templates/architect4/custom_css.css') }}" rel="stylesheet">
    <style>
        /* toast */
        @keyframes shrink {
            from { width: 100%; }
            to { width: 0%; }
        }
        .todo-indicator{
            position:absolute;width:4px;height:60%;border-radius:.3rem;left:.625rem;top:20%;opacity:.6;transition:opacity .2s
        }
        .todo-list-wrapper .list-group-item:hover .todo-indicator{opacity:.9}
        .todo-list-wrapper .custom-control,.todo-list-wrapper input[checkbox]{margin-left:.625rem}
        .list-group-flush+.card-footer{border-top:0}.rm-list-borders .list-group-item{border:0;padding:.5rem 0}.rm-list-borders-scroll .list-group-item{border:0;padding-right:1.125rem}
    </style>
</head>
<body>
    <div id="loader" class="position-fixed top-0 start-0 w-100 h-100 bg-white d-flex justify-content-center align-items-center" style="z-index: 1055;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
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
                        <div class="toast-progress position-absolute bottom-0 start-0 bg-light" style="height: 4px; width: 100%; animation: shrink linear forwards;"></div>
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
                        <div class="toast-progress position-absolute bottom-0 start-0 bg-light" style="height: 4px; width: 100%; animation: shrink linear forwards;"></div>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
        
        @include('admin.layouts.header')

        <div class="app-main">
            @include('admin.layouts.sidebar')

            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</body>
</html>