<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManajemenTask as Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    public function index()
    {
        $tasks = Todo::with('user')->latest()->get();
        $user = Auth::user();

        $quote = 'Gagal memuat kutipan.';
        $author = '';

        try {
            $response = Http::withOptions(['verify' => false])
                            ->get('https://api.quotable.io/random');

            if ($response->successful()) {
                $quote = $response['content'];
                $author = $response['author'];
            }
        } catch (\Exception $e) {
            // optional: log error
        }

        return response()->json([
            'title'  => 'Beranda | TODO',
            'user'   => $user,
            'tasks'  => $tasks,
            'quote'  => $quote,
            'author' => $author,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['judul' => 'required']);

        return Todo::create([
            'judul'   => $request->judul,
            'user_id' => Auth::id(),   // ✅ tambahkan ini
            'is_done' => 'undone',        // default false
        ]);
    }

    public function update(Request $request, $id)
{
    
    $request->validate([
        'is_done' => 'required|in:done,undone',
    ]);

    $task = Todo::where('user_id', auth()->id())->findOrFail($id);
    $task->update(['is_done' => $request->is_done]);

    return response()->json(['message' => 'Berhasil']);
}



    public function destroy($id)
    {
        Todo::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
