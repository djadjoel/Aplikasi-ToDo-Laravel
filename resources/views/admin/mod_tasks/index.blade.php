@extends('admin.layouts.app')

@section('content')
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div id="statusToast" class="toast text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center">
                <div class="toast-body d-flex align-items-center gap-2">
                    <span id="toastIcon" class="bi"></span>
                    <span id="toastMessage"></span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="progress" style="height: 4px;">
                <div id="toastProgress" class="progress-bar bg-warning" role="progressbar" style="width: 100%; transition: width 3s linear;"></div>
            </div>
        </div>
    </div>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="bi bi-list-task icon-gradient bg-mean-fruit"></i>
                </div>
                <div>TODO Dashboard
                    <div class="page-title-subheading">Manajemen Tugas.</div>
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-bs-toggle="tooltip" title="Example Tooltip" data-bs-placement="bottom" class="btn-shadow me-3 btn btn-dark">
                    <i class="bi bi-star"></i>
                </button>
                <div class="d-inline-block dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                        <span class="btn-icon-wrapper pe-2 opacity-7">
                            <i class="bi bi-briefcase fa-w-20"></i>
                        </span>
                        Filter Tugas
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('tasks.index') }}" class="nav-link  btn-outline-secondary {{ $status === null ? 'active' : '' }}">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>Semua</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tasks.index', ['status' => 'done']) }}" class="nav-link btn-outline-success {{ $status === 'done' ? 'active' : '' }}">
                                    <i class="nav-link-icon lnr-book"></i>
                                    <span>Selesai</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tasks.index', ['status' => 'undone']) }}" class="nav-link btn-outline-warning {{ $status === 'undone' ? 'active' : '' }}">
                                    <i class="nav-link-icon lnr-picture"></i>
                                    <span>Belum</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form id="add-task-form" class="row g-2 needs-validation" novalidate action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="col-md-4">
                            <input type="text" name="judul" class="form-control form-control-sm" placeholder="Judul tugas..." aria-label="Judul tugas" required>
                            <div class="invalid-feedback">Judul tidak boleh kosong.</div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi tugas..." aria-label="Deskripsi tugas" required>
                            <div class="invalid-feedback">Deskripsi tidak boleh kosong.</div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-primary w-100">+ Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <i class="header-icon bi bi-database icon-gradient bg-malibu-beach"> </i>To Do List
                    </div>
                </div>
                <div class="card-body">
                    <ul class="todo-list-wrapper list-group list-group-flush">
                        @if($tasks->isEmpty())
                            <div class="alert alert-light text-center">Tidak ada tugas.</div>
                        @else
                        @foreach ($tasks as $task)
                            <li class="list-group-item">
                                <div class="todo-indicator bg-warning"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-2">  
                                            <div class="form-check">
                                                <input 
                                                    type="checkbox"
                                                    class="form-check-input toggle-status"
                                                    data-id="{{ $task->id }}"
                                                    data-label-id="label-{{ $task->id }}"
                                                    id="task-{{ $task->id }}"
                                                    {{ $task->is_done === 'done' ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">
                                                {{ $task->judul }}
                                                <span id="status-badge-{{ $task->id }}">
                                                    @if($task->is_done === 'done')
                                                        <span class="badge bg-success ms-2">Selesai</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark ms-2">Belum</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="widget-subheading">{{ $task->deskripsi }}</div>
                                            <div class="widget-subheading"><i>Ditambahkan oleh {{ $task->user->name ?? 'Tidak diketahui' }}</i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm border-0 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}"><i class="bi bi-pencil"></i></button>
                                                <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="modal-content">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">Edit Tugas</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="judul{{ $task->id }}" class="form-label">Judul</label>
                                                                    <input type="text" name="judul" id="judul{{ $task->id }}" class="form-control" value="{{ $task->judul }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="deskripsi{{ $task->id }}" class="form-label">Deskripsi</label>
                                                                    <textarea name="deskripsi" id="deskripsi{{ $task->id }}" class="form-control" rows="3">{{ $task->deskripsi }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm border-0 btn-transition btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $task->id }}" title="Hapus"><i class="bi bi-trash"></i></button>
                                                <div class="modal fade" id="confirmDeleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah kamu yakin ingin menghapus tugas <strong>{{ $task->judul }}</strong>?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection