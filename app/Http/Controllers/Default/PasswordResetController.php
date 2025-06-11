<?php

namespace App\Http\Controllers\Default;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        $link = url('/default/reset-password/' . $token . '?email=' . urlencode($request->email));

        Mail::raw("Klik link berikut untuk reset password Anda: $link", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Password Anda');
        });

        return back()->with('message', 'Link reset password telah dikirim ke email Anda.');
    }

    public function showResetForm($token, Request $request)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        // Cek apakah token ada
        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Token tidak valid.']);
        }

        // ⏰ Cek apakah token sudah kedaluwarsa (60 menit)
        $createdAt = Carbon::parse($record->created_at);
        if ($createdAt->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'Token sudah kedaluwarsa. Silahkan minta ulang.']);
        }

        // Reset password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token setelah digunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/default/login')->with('message', 'Password berhasil direset. Silakan login.');
    }

}
