<form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
    @csrf
    @if(isset($task)) @method('PUT') @endif

    <input type="text" name="title" placeholder="Judul" value="{{ old('title', $task->title ?? '') }}" required>
    <textarea name="description" placeholder="Deskripsi">{{ old('description', $task->description ?? '') }}</textarea>
    
    <button type="submit">{{ isset($task) ? 'Update' : 'Create' }}</button>
</form>
