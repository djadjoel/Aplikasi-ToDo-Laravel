<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;
// use App\Models\Publik\Beranda;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ManajemenTask as Todo;

class BerandaController extends Controller
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
            // log error kalau perlu
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
