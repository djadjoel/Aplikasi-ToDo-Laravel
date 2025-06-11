const token = localStorage.getItem('token');
if (!token) window.location.href = 'login';

const authHeader = {
  headers: {
    Authorization: `Bearer ${token}`,
    Accept: 'application/json',
  }
};

function loadTodos() {
  axios.get(BASE_API + '/api/beranda', authHeader)
    .then(res => {
      const list = document.getElementById('todoList');
      list.innerHTML = '';
      res.data.tasks.forEach(todo => {
        const item = document.createElement('li');
        item.className = 'list-group-item d-flex justify-content-between align-items-center';

        const div = document.createElement('div');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.checked = todo.is_done === 'done'; // ✅ enum aware
        checkbox.addEventListener('change', () => {
          const newStatus = todo.is_done === 'done' ? 'undone' : 'done';
          toggleTodo(todo.id, newStatus);
        });

        checkbox.addEventListener('change', () => {
          const newStatus = checkbox.checked ? 'done' : 'undone'; // ✅ enum aware
          toggleTodo(todo.id, newStatus);
        });

        const span = document.createElement('span');
        span.textContent = todo.judul || '[Tanpa Judul]';
        if (todo.is_done === 'done') span.classList.add('text-decoration-line-through'); // ✅ enum aware

        div.appendChild(checkbox);
        div.appendChild(span);

        const btn = document.createElement('button');
        btn.className = 'btn btn-sm btn-danger';
        btn.textContent = 'Hapus';
        btn.addEventListener('click', () => deleteTodo(todo.id));

        item.appendChild(div);
        item.appendChild(btn);
        list.appendChild(item);
      });
    })
    .catch(err => {
      console.error('Gagal memuat todos:', err);
      alert('Gagal memuat daftar tugas nih.');
    });
}

function addTodo() {
  const input = document.getElementById('newTodo');
  const judul = input.value.trim();
  if (!judul) return;

  const button = input.nextElementSibling;
  button.disabled = true;
  button.textContent = 'Menambah...';

  // Tampilkan toast loading
  Swal.fire({
    title: 'Menambah tugas...',
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  axios.post(BASE_API + '/api/beranda', { judul }, authHeader)
    .then(() => {
      input.value = '';
      loadTodos();

      // Sukses toast
      Swal.fire({
        icon: 'success',
        title: 'Tugas berhasil ditambahkan!',
        toast: true,
        position: 'top-end',
        timer: 2000,
        showConfirmButton: false,
      });
    })
    .catch(() => {
      Swal.fire({
        icon: 'error',
        title: 'Gagal menambahkan tugas!',
        toast: true,
        position: 'top-end',
        timer: 2000,
        showConfirmButton: false,
      });
    })
    .finally(() => {
      button.disabled = false;
      button.textContent = 'Tambah';
    });
}


function toggleTodo(id, newStatus) {
  showToast('Menyimpan status tugas...');

  axios.put(BASE_API + `/api/beranda/${id}`, { is_done: newStatus }, authHeader)
    .then(() => {
      loadTodos();
      showToast('Status berhasil diperbarui', 'success');
    })
    .catch(err => {
      console.error(err);
      showToast('Gagal memperbarui status', 'danger');
    });
}




function deleteTodo(id) {
  Swal.fire({
    title: 'Hapus tugas ini?',
    text: 'Tindakan ini tidak bisa dibatalkan!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      showToast('Menghapus tugas...');

      axios.delete(BASE_API + `/api/beranda/${id}`, authHeader)
        .then(() => {
          loadTodos();
          Swal.fire('Terhapus!', 'Tugas berhasil dihapus.', 'success');
        })
        .catch(err => {
          console.error(err);
          Swal.fire('Gagal', 'Tugas gagal dihapus.', 'error');
        });
    }
  });
}





function logout() {
  localStorage.removeItem('token');
  window.location.href = BASE_API + '/login';
}

function showToast(message, type = 'primary') {
  const toastEl = document.getElementById('statusToast');
  const toastBody = document.getElementById('statusToastBody');

  toastEl.className = `toast align-items-center text-bg-${type} border-0`; // ubah warna
  toastBody.textContent = message;

  const bsToast = new bootstrap.Toast(toastEl, { delay: 2000 });
  bsToast.show();
}


loadTodos();