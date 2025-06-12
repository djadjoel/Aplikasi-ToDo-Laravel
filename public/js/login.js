const BASE_API = 'https://aplikasi-todo-laravel-production.up.railway.app';
console.log("Login to:", BASE_API + '/login');
function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    console.log("Login to:", BASE_API + '/login');

    axios.post(BASE_API + '/login', { email, password })
    .then(res => {
        localStorage.setItem('token', res.data.token);
        window.location.href = 'beranda';
    })
    .catch(err => {
        console.error("Login error:", err.response?.data || err.message);
        document.getElementById('error').innerText = 'Login gagal';
    });
}
