<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $verifyUrl;

    public function __construct(string $token)
    {
        $this->verifyUrl = route('verify.email', $token);
    }

    public function build()
    {
        return $this->subject('Verifikasi Email Akun KlikDoc')
                    ->view('emails.verify-email');
    }
}
