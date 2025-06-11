<?php

namespace App\Http\Controllers\Default;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function notice()
    {
        // $user = Auth::user();

        // $url = URL::temporarySignedRoute(
        //     'verification.verify',
        //     now()->addMinutes(60),
        //     ['id' => $user->id, 'hash' => sha1($user->email)]
        // );

        // return view('auth.verify-email', [
        //     'user' => $user,
        //     'url' => $url,
        // ]);
        return view('auth.verify-notice', ['user' => Auth::user()]);
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals(sha1($user->email), $hash)) {
            abort(403, 'Link verifikasi tidak valid.');
        }

        $user->email_verified_at = now();
        $user->save();

        if ($user->hasVerifiedEmail()) {
            return redirect('/admin/dashboard')->with('message', 'Email sudah diverifikasi.');
        }
    }

    public function resend()
    {
        $user = Auth::user();
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        Mail::send('auth.verify-email', ['user' => $user, 'url' => $url], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verifikasi Email Anda');
        });

        return back()->with('message', 'Link verifikasi dikirim ulang!');
    }
}
