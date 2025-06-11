<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ManajemenTask as Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Task::query();

        if (!in_array($status, ['done', 'undone', null])) {
            return redirect()->route('tasks.index');
        }

        if ($status === 'done') {
            $query->where('is_done', 'done');
        } elseif ($status === 'undone') {
            $query->where('is_done', 'undone');
        }

        $tasks = $query->with('user')->latest()->get();

        $user = Auth::user();

        $doneCount = Task::where('is_done', 'done')->count();
        $undoneCount = Task::where('is_done', 'undone')->count();

        return view('admin.mod_tasks.index', [
            'title'  => 'Manajemen Task | TODO',
            'tasks'  => $tasks,
            'status' => $status,
            'user'   => $user,
            'doneCount'   => $doneCount,
            'undoneCount' => $undoneCount,
        ]);
    }
    public function create()
    {
        return view('admin.mod_tasks.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
        ]);
        Task::create([
            'user_id'   => Auth::id(),
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'is_done'   => false, // default
        ]);
        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $task->update($request->only(['judul', 'deskripsi']));

        return redirect()->route('tasks.index')->with('message', 'Tugas berhasil diupdate.');
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('message', 'Tugas berhasil dihapus.');
    }
    public function toggleStatus(Task $task)
    {
        $task->is_done = $task->is_done === 'done' ? 'undone' : 'done';
        $task->save();

        return response()->json([
            'success' => true,
            'new_status' => $task->is_done
        ]);
    }
}