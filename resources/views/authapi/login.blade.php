<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-3">Login</h2>
    <form onsubmit="event.preventDefault(); login();">
    <div class="mb-3">
        <input id="email" class="form-control" placeholder="Email">
    </div>
    <div class="mb-3">
        <input id="password" type="password" class="form-control" placeholder="Password">
    </div>
    <button onclick="login()" class="btn btn-primary">Login</button>
    <p id="error" class="text-danger mt-3"></p>
</form>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <script>
    const BASE_API = "{{ url('/api') }}";
</script>

</body>
</html>
