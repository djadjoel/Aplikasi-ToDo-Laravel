@extends('publik.theme1.layout')

@section('content')
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary"> 
  <div class="col-lg-6 px-0"> 
    <h1 class="display-4 fst-italic">Motivasi Harian</h1>
    <p class="lead my-3">
      {{ $quote }} — <strong>{{ $author }}</strong>
    </p>
  </div> 
</div>
<h2 class="mb-4">Login</h2>

  <div class="mb-3">
    <input type="email" id="email" class="form-control" placeholder="Email">
  </div>
  <div class="mb-3">
    <input type="password" id="password" class="form-control" placeholder="Password">
  </div>
  <button class="btn btn-primary" onclick="login()">Login</button>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    function login() {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      axios.post('/api/login', { email, password })
        .then(res => {
          localStorage.setItem('token', res.data.token);
          window.location.href = '/';
        })
        .catch(err => alert('Login gagal'));
    }
  </script>
@endsection