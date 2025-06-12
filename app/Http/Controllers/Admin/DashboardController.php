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

        try {
            $response = Http::get('https://zenquotes.io/api/random');
            $json = $response->json();
            if ($response->successful() && is_array($json) && isset($json[0]['q'], $json[0]['a'])) {
                $quote = $json[0]['q'];
                $author = $json[0]['a'];
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengambil kutipan motivasi.', [
                'url' => 'https://zenquotes.io/api/random',
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
