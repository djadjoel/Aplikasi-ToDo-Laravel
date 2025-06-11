<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="bi bi-car-front icon-gradient bg-mean-fruit"></i>
                </div>
                <div>TODO Dashboard
                    <div class="page-title-subheading">Halaman Dashboard.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <blockquote class="blockquote">
                    <p>"{{ $quote }}"</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <cite title="Source Title">{{ $author }}</cite>
                </figcaption>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Tugas</div>
                        <div class="widget-subheading">Belum Selesai</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $undoneCount }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Tugas</div>
                        <div class="widget-subheading">Sudah Selesai</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $doneCount }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Tugas</div>
                        <div class="widget-subheading">Seluruhnya</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $allCount }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-header">Grafik Tugas</div>
                <div class="card-body">
                    <canvas id="taskStatusChart" height="80%"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-header">User Login</div>
                <div class="card-body text-center">
                    <i class="bi bi-person-badge" style="font-size: 7.5rem; color: cornflowerblue;"></i>
                    <div class="mt-3">
                        <p class="mb-2">
                            <span id="userName"><h5>{{ $user->name }}</h5></span>
                        </p>
                        <p class="mb-0">
                            <strong><i class="bi bi-envelope-fill me-2"></i></strong>
                            <span id="userEmail">{{ $user->email }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Daftar Tugas</div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped" id="tasks-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Ditambahkan Oleh</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $index => $task)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $task->judul }}</td>
                                        <td>{{ $task->deskripsi }}</td>
                                        <td>
                                            @if ($task->is_done === 'done')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Belum</span>
                                            @endif
                                        </td>
                                        <td>{{ $task->user->name ?? 'Tidak diketahui' }}</td>
                                        <td>{{ $task->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
@endsection

<!-- DataTables-->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tasks-table').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ tugas",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                },
                zeroRecords: "Tidak ada tugas ditemukan"
            },
            responsive: true
        });
    });
</script>


