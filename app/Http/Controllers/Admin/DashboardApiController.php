<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Admin\ManajemenTask as Task;

class DashboardApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $doneCount = Task::where('is_done', 'done')->count();
        $undoneCount = Task::where('is_done', 'undone')->count();
        $allCount = Task::count();

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
            Log::error('Gagal mengambil kutipan', [
                'user_id' => $user->id ?? null,
                'exception' => $e,
            ]);
        }

        return response()->json([
            'user' => $user,
            'doneCount' => $doneCount,
            'undoneCount' => $undoneCount,
            'allCount' => $allCount,
            'quote' => $quote,
            'author' => $author,
        ]);
    }
}
