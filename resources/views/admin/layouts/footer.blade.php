<script src="{{ secure_asset('plugins/bootstrap533/bootstrap.bundle.min.js') }}"></script>
<script src="{{ secure_asset('templates/architect4/main.js') }}"></script>
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
    const toastEls = document.querySelectorAll('.auto-toast');
    toastEls.forEach(toastEl => {
        const delay = 5000; // 5 detik
        const toast = new bootstrap.Toast(toastEl, { delay });

        // Sinkronkan progress bar jika ada
        const progress = toastEl.querySelector('.toast-progress');
        if (progress) {
            progress.style.animationDuration = `${delay}ms`;
        }

        toast.show();
    });
  });
</script>
<script>
    const toastEl = document.getElementById('successToast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
</script>
<script>
  window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    setTimeout(function () {
      loader.classList.add('opacity-0');
      loader.classList.add('invisible');
    }, 300);
  });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('add-task-form');

    // Tambahkan event listener ke form
    form.addEventListener('submit', function (event) {
        // Jika form tidak valid, batalkan submit dan tampilkan feedback
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        // Tambahkan class Bootstrap untuk validasi
        form.classList.add('was-validated');
    });

    // Tambahkan validasi real-time saat mengetik
    const inputs = form.querySelectorAll('input[required]');
    inputs.forEach(function (input) {
        input.addEventListener('input', function () {
            if (input.checkValidity()) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        });
    });
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-status').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskId = this.dataset.id;
            const badgeContainer = document.getElementById('status-badge-' + taskId);
            const url = "{{ url('/admin/tasks') }}/" + taskId + "/toggle-status";

            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal mengubah status');
                return response.json();
            })
            .then(data => {
                if (data.success && badgeContainer) {
                    badgeContainer.innerHTML = data.new_status === 'done'
                        ? '<span class="badge bg-success ms-2">Selesai</span>'
                        : '<span class="badge bg-warning text-dark ms-2">Belum</span>';
                    // ✅ Tampilkan notifikasi toast
                    const toastElement = document.getElementById('statusToast');
                    const toastMessage = document.getElementById('toastMessage');
                    const toastIcon = document.getElementById('toastIcon');
                    const toastProgress = document.getElementById('toastProgress');

                    // Reset progress bar
                    toastProgress.style.transition = 'none';
                    toastProgress.style.width = '100%';

                    setTimeout(() => {
                        toastProgress.style.transition = 'width 3s linear';
                        toastProgress.style.width = '0%';
                    }, 10); // delay minimal agar reset efektif

                    if (data.new_status === 'done') {
                        toastMessage.textContent = 'Tugas ditandai sebagai selesai.';
                        toastElement.className = 'toast text-white bg-success border-0';
                        toastIcon.className = 'bi bi-check-circle-fill fs-5';
                    } else {
                        toastMessage.textContent = 'Status tugas diubah menjadi belum selesai.';
                        toastElement.className = 'toast bg-warning text-dark border-0';
                        toastIcon.className = 'bi bi-arrow-counterclockwise fs-5';
                    }

                    // Tampilkan toast
                    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
                    toast.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengubah status.');
                this.checked = !this.checked; // rollback centang
            });
        });
    });
});
</script>
<script src="{{ asset('plugins/chart/chart.min.js') }}"></script>
<script>
    const ctx = document.getElementById('taskStatusChart').getContext('2d');
    const taskStatusChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sudah Selesai', 'Belum Selesai'],
            datasets: [{
                label: 'Jumlah Tugas',
                data: @json([$doneCount, $undoneCount]),
                backgroundColor: ['#28a745', '#dc3545'],
                borderColor: ['#218838', '#c82333'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Statistik Status Tugas'
                }
            }
        }
    });
</script>
