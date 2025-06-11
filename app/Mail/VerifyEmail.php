<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $url = url('/default/email/verify/' . $this->user->id . '/' . sha1($this->user->email));
        return $this->subject('Verifikasi Email Anda')
            ->view('auth.verify-email')
            ->with(['url' => $url]);
    }
}
