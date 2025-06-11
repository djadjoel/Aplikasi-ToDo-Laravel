@extends('publik.theme1.layout')

@section('content')
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="statusToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="statusToastBody">
        Memproses...
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary"> 
  <div class="col-lg-6 px-0"> 
    <h1 class="display-4 fst-italic">Motivasi Harian</h1>
    <p class="lead my-3">
      {{ $quote }} — <strong>{{ $author }}</strong>
    </p>
  </div> 
</div>
<h2>Todo List</h2>
<div class="card mb-5">
  <div class="card-header">
    <div class="input-group">
      <input id="newTodo" class="form-control" placeholder="Tugas baru...">
      <button onclick="addTodo()" class="btn btn-primary">Tambah</button>
    </div>
  </div>
  <div class="card-body">
<ul id="todoList" class="list-group"></ul>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const BASE_API = "{{ url('') }}";
</script>
<script src="{{ asset('js/todo.js') }}"></script>
@endsection