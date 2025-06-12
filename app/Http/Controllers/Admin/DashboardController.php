<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Admin\ManajemenTask as Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data tugas dan statistik
        $tasks = Task::with('user')->latest()->get();
        $doneCount = Task::where('is_done', 'done')->count();
        $undoneCount = Task::where('is_done', 'undone')->count();
        $allCount = Task::count();

        // Default kutipan jika gagal
        $quote = 'Gagal memuat kutipan.';
        $author = '';

        // Ambil kutipan motivasi
        try {
            $response = Http::get('https://zenquotes.io/api/random');
            if ($response->successful()) {
                $quoteData = $response->json()[0];
                $quote = $quoteData['q'];
                $author = $quoteData['a'];
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengambil kutipan.', [
                'url' => 'https://api.quotable.io/random',
                'message' => $e->getMessage(),
                'user_id' => $user->id ?? null,
                'trace' => $e->getTraceAsString()
            ]);
        }

        return view('admin.dashboard', [
            'title'        => 'Beranda | TODO',
            'user'         => $user,
            'tasks'        => $tasks,
            'quote'        => $quote,
            'author'       => $author,
            'doneCount'    => $doneCount,
            'undoneCount'  => $undoneCount,
            'allCount'  => $allCount,
        ]);
    }

}
