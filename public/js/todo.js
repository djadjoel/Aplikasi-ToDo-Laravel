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
        item.className = 'list-group-item d-flex justify-content-between flex-wrap align-items-center';

        const div = document.createElement('div');
        div.className = 'd-flex align-items-center gap-2';

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.checked = todo.is_done === 'done';
        checkbox.addEventListener('change', () => {
          const newStatus = checkbox.checked ? 'done' : 'undone';
          toggleTodo(todo.id, newStatus);
        });

        const span = document.createElement('span');
        span.textContent = todo.judul || '[Tanpa Judul]';
        if (todo.is_done === 'done') span.classList.add('text-decoration-line-through');

        div.appendChild(checkbox);
        div.appendChild(span);

        const editBtn = document.createElement('button');
        editBtn.className = 'btn btn-sm btn-outline-warning';
        editBtn.innerHTML = '<i class="bi bi-pencil"></i>';
        editBtn.setAttribute('title', 'Edit');
        editBtn.addEventListener('click', () => editTodo(todo));

        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn btn-sm btn-outline-danger';
        deleteBtn.innerHTML = '<i class="bi bi-trash"></i>';
        deleteBtn.setAttribute('title', 'Hapus');
        deleteBtn.addEventListener('click', () => deleteTodo(todo.id));

        const btnGroup = document.createElement('div');
        btnGroup.className = 'd-flex gap-2 mt-2 mt-md-0'; // responsive gap + spacing
        btnGroup.appendChild(editBtn);
        btnGroup.appendChild(deleteBtn);

        item.appendChild(div);
        item.appendChild(btnGroup);
        list.appendChild(item);
      });

    })
    .catch(err => {
      console.error('Gagal memuat todos:', err);
      alert('Gagal memuat daftar tugas nih. Login dulu ya.');
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

function editTodo(todo) {
  Swal.fire({
    title: 'Edit Tugas',
    input: 'text',
    inputValue: todo.judul,
    showCancelButton: true,
    confirmButtonText: 'Simpan',
    cancelButtonText: 'Batal',
    inputValidator: (value) => {
      if (!value) return 'Judul tidak boleh kosong!';
    }
  }).then((result) => {
    if (result.isConfirmed) {
      const newTitle = result.value.trim();
      if (newTitle === todo.judul) return; // Tidak berubah

      showToast('Menyimpan perubahan...');

      axios.put(BASE_API + `/api/beranda/${todo.id}`, { judul: newTitle }, authHeader)
        .then(() => {
          loadTodos();
          showToast('Tugas berhasil diupdate!', 'success');
        })
        .catch(err => {
          console.error(err);
          showToast('Gagal memperbarui tugas!', 'danger');
        });
    }
  });
}


loadTodos();