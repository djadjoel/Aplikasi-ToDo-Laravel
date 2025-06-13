<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;
// use App\Models\Publik\Beranda;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ManajemenTask as Todo;
use Illuminate\Support\Facades\Log;

class BerandaController extends Controller
{
    public function index()
    {
        $tasks = Todo::with('user')->latest()->get();
        $user = Auth::user();

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

        return view('publik.theme1.beranda.beranda', [
            'title'  => 'Beranda | TODO',
            'user'   => $user,
            'tasks'  => $tasks,
            'quote'  => $quote,
            'author' => $author,
        ]);
    }
}
