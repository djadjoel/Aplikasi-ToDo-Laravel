function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    //console.log({ email, password });

    axios.post(BASE_API + '/login', { email, password })

    .then(res => {
        localStorage.setItem('token', res.data.token);
        window.location.href = 'beranda';
    })
    .catch(err => {
        console.error("Login error:", err.response);
        document.getElementById('error').innerText = 'Login gagal';
    });
}

