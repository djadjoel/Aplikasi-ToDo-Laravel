<?php

namespace App\Http\Controllers\Default;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        $a = rand(1, 9);
        $b = rand(1, 9);
        session(['captcha_answer' => $a + $b]);
        return view('auth.login', compact('a', 'b'));
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'captcha' => ['required', 'numeric'],
        ]);

        if ((int) $request->input('captcha') !== (int) session('captcha_answer')) {
            return back()->withErrors(['captcha' => 'Jawaban captcha salah.']);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (is_null(Auth::user()->email_verified_at)) {
                return redirect()->route('verification.notice')
                    ->with('message', 'Silakan verifikasi email Anda terlebih dahulu.');
            }

            // return redirect()->intended('/admin/dashboard')->with('message', 'Berhasil login!');
            
            $user = Auth::user();
            
            if (is_null($user->email_verified_at)) {
                return redirect()->route('verification.notice')
                    ->with('message', 'Silakan verifikasi email Anda terlebih dahulu.');
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('message', 'Berhasil login!');
            }
            Auth::logout();
            return redirect('/default/login')->withErrors(['email' => 'Role tidak dikenali.']);
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka
                'regex:/[@$!%*#?&]/', // simbol khusus
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'   => 'admin', // default
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect()->intended('/default/email/verify');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/default/login')->with('message', 'Berhasil logout!');
    }
}