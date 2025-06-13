<!DOCTYPE html>
<html lang="id" data-bs-theme="auto"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="baniakoy.com">
    <title>Todo</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ secure_asset('plugins/bootstrap533/color-modes.js') }}"></script>
    <link href="{{ secure_asset('plugins/bootstrap533/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900&display=swap" rel="stylesheet">
    <link href="{{ secure_asset('templates/blog/css/blog.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('templates/blog/css/custom.css') }}" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="{{ secure_asset('gambar/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ secure_asset('gambar/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ secure_asset('gambar/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('gambar/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ secure_asset('gambar/favicon/site.webmanifest') }}" />
    <style>
        /* toast */
        @keyframes shrink {
            from { width: 100%; }
            to { width: 0%; }
        }
        .list-group-item {
          flex-direction: column;
        }

        @media (min-width: 768px) {
          .list-group-item {
            flex-direction: row;
          }
        }
    </style>
  </head>
  <body>
    @include('publik.theme1.notif')
    @include('publik.theme1.color')
    @include('publik.theme1.header')
    <main class="container">
      @yield('content')
    </main>
    @include('publik.theme1.footer')
  </body>
</html>